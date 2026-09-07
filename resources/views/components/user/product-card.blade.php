@php
    $badge = /*$product['badge']*/ "" ?? null;
    $rating = (float) ($product->product_rating ?? 0);
    $reviews = (int) (/*$product['review_count']*/ "" ?? 0);
    $in_wish = (bool) (/*$product['in_wishlist']*/ "" ?? false);
    $stars = str_repeat('★', round($rating)) . str_repeat('☆', 5 - round($rating));
@endphp

<div class="product-card">

    <div class="product-image-wrap">

        <a href="/product/{{ e($product->id) }}">
            <img src="/assets/images/{{ e($product->product_image ?? '/IMG-20260822-WA0023.jpg') }}"
                alt="{{ e($product->product_name) }}" loading="lazy">
        </a>

        {{-- @if ($badge)
        <div class="product-badges">
            <span class="product-badge badge-{{ e($badge) }}">
                {{ ucfirst(e($badge)) }}
            </span>
        </div>
        @endif --}}

        <div class="product-actions-hover">
            <button class="btn-add-cart" data-action="add-to-cart" data-id="{{ e($product->id) }}"
                data-name="{{ e($product->product_name) }}" data-price="{{   e($product->product_price) }}"
                data-image="/assets/images/{{ e($product->product_image ?? '') }}" {{ ($badge === 'sold') ? 'disabled' : '' }}>
                {{ ($badge === 'sold') ? 'Sold Out' : 'Add to Cart' }}
            </button>
            <button class="btn-wishlist {{   $in_wish ? 'active' : '' }}" data-action="toggle-wishlist" data-id="
            {{ e($product->id) }}" data-name="{{   e($product->product_name) }}"
                data-price="{{ e($product->product_price) }}"
                data-image="/assets/images/{{ e($product->product_image ?? '') }}"
                aria-label="Add to wishlist">{{ $in_wish ? '♥' : '♡' }}</button>
        </div>
    </div>

    <div class="product-info">

        @if (!empty($product->product_category))
            <div class="product-category">
                {{ e($product->product_category) }}
            </div>
        @endif

        <a href="/product/{{ e($product->product_name) }}">
            <h3 class="product-name">{{ e($product->product_name) }}</h3>
        </a>

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
                {{ price($product->product_price) }}
            </span>
            {{-- @if ($old_price)
            <span class="price-old">
                {{ price($old_price) }}
            </span>
            @endif --}}
        </div>
    </div>

</div>
