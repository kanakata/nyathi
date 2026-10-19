@php
    use Illuminate\Support\Facades\Crypt;
    // $product->product_badge = ;
    $rating = (float) ($product->product_rating ?? 0);
    $reviews = (int) (/*$product['review_count']*/ "" ?? 0);
    $in_wish = (bool) (/*$product['in_wishlist']*/ "" ?? false);
    $stars = str_repeat('★', round($rating)) . str_repeat('☆', 5 - round($rating));
    $id = Crypt::encryptString((str($product->product_id)));
@endphp
<div class="product-card">

    <div class="product-image-wrap">

        @if($product->product_badge == "available")
            <a href="/user/product/{{ $id }}" class="product-link">
                <img src="{{ asset("storage/product-images/" . $product->product_image) }}"
                    alt="{{ $product->product_image}}" loading="lazy">
            </a>
        @else
            <a class="product-link">
                <img src="{{ asset("storage/product-images/" . $product->product_image) }}"
                    alt="{{ e($product->product_name) }}" loading="lazy">
            </a>
        @endif

        @if ($product->product_badge)
            <div class="product-badges">
                <span class="product-badge badge-{{ e($product->product_badge) }}">
                    {{ ucfirst(e($product->product_badge)) }}
                </span>
            </div>
        @endif

        <div class="product-actions-hover">
            <button class="btn-add-cart" data-action="add-to-cart" data-id="{{ e($product->product_id) }}"
                data-name="{{ e($product->product_name) }}" data-price="{{ e($product->product_price) }}"
                data-image="{{ e(asset("storage/" . $product->product_image) ?? '') }}" {{ ($product->product_badge === 'sold') ? 'disabled' : '' }}>
                {{ ($product->product_badge === 'sold') ? 'Sold Out' : 'Add to Cart' }}
            </button>
            <button class="btn-wishlist {{   $in_wish ? 'active' : '' }}" data-action="toggle-wishlist" data-id="
            {{ e($product->product_id) }}" data-name="{{   e($product->product_name) }}"
                data-price="{{ e($product->product_price) }}"
                data-image="{{ e(asset("storage/" . $product->product_image) ?? '') }}"
                aria-label="Add to wishlist">{{ $in_wish ? '♥' : '♡' }}</button>
        </div>
    </div>

    <div class="product-info">

        @if (!empty($product->product_category))
            <div class="product-category">
                {{ e($product->product_category) }}
            </div>
        @endif

        @if ($product->product_badge == "available")
            <a class="product-link" href="/user/product/{{ e($id) }}">
                <h1 class="product-name">{{ e($product->product_name) }}</h1>
            </a>
        @else
            <a class="product-link">
                <h1 class="product-name">{{ e($product->product_name) }}</h1>
            </a>
        @endif


        @if ($rating > 0)
            <div class="product-rating">
                <span class="stars" title="{{ $rating }} out of 5">
                    {{ $stars }}
                </span>
                @if ($reviews > 0)
                    <span class="rating-count">(
                        {{ $reviews }})</span>
                @endif
            </div>
        @endif

        <div class="product-price">
            <span class="price-current">
                {{ price($product->product_price - $product->product_discount) }}
            </span>
            @if ($product->product_discount)
                <span class="price-old">
                    {{ price($product->product_price) }}
                </span>
            @endif
        </div>
    </div>

</div>
