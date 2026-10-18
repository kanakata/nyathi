<?php

/**
 * LUXE SHOP — Admin: Add / Edit Product Form
 */
// require_once __DIR__ . '/../../includes/config';
// if (!isAdmin()) redirect('/auth/login');

$isEdit = isset($_GET['id']);
$adminTitle = $isEdit ? 'Edit Product' : 'Add Product';
$adminSection = 'products';
?>

<x-admin.header></x-admin.header>

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
    <a href="/admin/products" class="btn btn-ghost btn-sm">← Back to Products</a>
    <?php if ($isEdit): ?>
    <a href="/user/product/{{  }}" target="_blank" class="btn btn-ghost btn-sm">View Live
        →</a>
    <?php endif; ?>
</div>

<form method="POST" action="/admin/product-save" enctype="multipart/form-data">
    <?php if ($isEdit): ?>
    <input type="hidden" name="id" value="">
    <?php endif; ?>

    @csrf

    <div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start">

        {{-- LEFT --}}
        <div>
            {{-- Basic Info --}}
            <div class="checkout-section">
                <div class="checkout-section-title">Product Information</div>
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="product_name" class="form-control" required data-maxlength="120"
                        value="shujaa fan kit">
                </div>
                <div class="form-group">
                    <label>Product Brand</label>
                    <input type="text" name="product_brand" class="form-control" required data-maxlength="120"
                        value="umbro">
                </div>
                <div class="form-group">
                    <label>Product Description</label>
                    <textarea name="product_description" class="form-control" rows="5"
                        data-maxlength="2000">Shujaa fan kit is a premium quality fan kit designed for sports enthusiasts.</textarea>
                </div>
                {{-- <div class="form-row">
                    <div class="form-group">
                        <label>SKU</label>
                        <input type="text" name="sku" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label>Weight (kg)</label>
                        <input type="number" name="weight" class="form-control" step="0.1" min="0" value="">
                    </div>
                </div> --}}
            </div>

            {{-- Pricing --}}
            <div class="checkout-section">
                <div class="checkout-section-title">Pricing</div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="product_price" class="form-control" step="0.01" min="0" required value="4500">
                    </div>
                    <div class="form-group">
                        <label>Discount <small style="color:var(--text-muted)">(optional)</small></label>
                        <input type="number" name="product_discount" class="form-control" step="0.01" min="0" value="10">
                    </div>
                </div>
            </div>

            {{-- Variants --}}
            {{-- <div class="checkout-section">
                <div class="checkout-section-title">Variants</div>
                <div class="form-group">
                    <label>Sizes <small style="color:var(--text-muted)">(comma-separated)</small></label>
                    <input type="text" name="sizes" class="form-control" placeholder="XS,S,M,L,XL" value="">
                </div>
                <div class="form-group">
                    <label>Colours <small style="color:var(--text-muted)">(comma-separated)</small></label>
                    <input type="text" name="colors" class="form-control" placeholder="Black,White,Camel" value="">
                </div>
                <div class="form-group">
                    <label>Cupons <small style="color:var(--text-muted)">(comma-separated)</small></label>
                    <input type="text" name="colors" class="form-control" placeholder="Black,White,Camel" value="">
                </div>
            </div> --}}

            {{-- SEO --}}
            <div class="checkout-section">
                <div class="checkout-section-title">SEO (optional)</div>
                <div class="form-group">
                    <label>Meta Title</label>
                    <input type="text" name="product_meta_title" class="form-control" data-maxlength="60"
                        value="Shujaa Fan Kit">
                </div>
                <div class="form-group">
                    <label>Meta Description</label>
                    <textarea name="product_meta_description" class="form-control" rows="2"
                        data-maxlength="160">Shujaa Fan Kit - Premium quality fan kit designed for sports enthusiasts.</textarea>
                </div>
            </div>
        </div>

        {{-- RIGHT --}}
        <div>
            {{-- Status --}}
            <div class="checkout-section">
                <div class="checkout-section-title">Status & Visibility</div>
                {{-- <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" >Active
                        </option>
                        <option value="draft" >Draft
                        </option>
                        <option value="archived"
                            >Archived</option>
                    </select>
                </div> --}}
                <div class="form-group">
                    <label>Badge</label>
                    <select name="product_badge" class="form-control">
                        {{-- <option value="available">available</option> --}}
                        <option value="available" >available
                        </option>
                        <option value="sold">Sold</option>
                    </select>
                </div>
                {{-- <div style="display:flex;align-items:center;gap:0.5rem">
                    <input type="checkbox" id="featured" name="featured" value="1" style="accent-color:var(--gold)">
                    <label for="featured" style="font-size:0.85rem;cursor:pointer">Feature on Homepage</label>
                </div> --}}
            </div>

            {{-- Category --}}
            <div class="checkout-section">
                {{-- <div class="checkout-section-title">Organisation</div> --}}
                <div class="form-group">
                    <label>Product Category</label>
                    <select name="product_category" class="form-control" required>
                        <option value="">Select category…</option>
                        {{-- Backend: render <option> from $categories --}}
                        <option value="training" >training</option>
                        <option value="fan-kit" >fan kit</option>
                        <option value="foot-ware" >foot ware</option>
                        <option value="medical" >medical</option>
                        <option value="protective-gear" >protective gear
                        </option>
                        <option value="" >equipment</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Available Product Colors</label>
                    <div class="form-group" style="overflow-y: scroll; max-height: 150px;">
                        @foreach ($colors as $color)
                            <div class="form-check colors" style="display: flex; gap: 0.5rem; height: 2rem; align-items: center;">
                                <input class="form-check-input" type="checkbox" name="product_colors[]" id="color-{{ $color }}" value="{{ $color }}">
                                <label class="form-check-label" for="color-{{ $color }}">{{ $color }}</label>
                            </div>
                        @endforeach
                </div>


                <div class="form-group">
                    <label>Available Product Sizes</label>
                    {{-- use checkbox --}}
                    <div class="form-group" style="overflow-y: scroll; max-height: 150px;">
                        @foreach ($sizes as $size)
                            <div class="form-check sizes" style="display: flex; gap: 0.5rem; height: 2rem; align-items: center;">
                                <input class="form-check-input" type="checkbox" name="product_sizes[]" id="size-{{ $size }}" value="{{ $size }}">
                                <label class="form-check-label" for="size-{{ $size }}">{{ $size }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <script>
                    const  colors = ['red', 'white', 'blue', 'black', 'green', 'yellow', 'orange', 'purple', 'pink', 'brown', 'gray', 'cyan', 'magenta', 'lime', 'teal', 'indigo', 'vioconst ', 'gold', 'silver', 'bronze', 'maroon', 'navy', 'olive', 'aqua', 'fuchsia', 'coral', 'salmon', 'khaki', 'lavender', 'plum', 'orchid', 'periwinkle', 'mint', 'peach', 'apricot', 'amber', 'cerulean', 'sapphire', 'emerald', 'ruby', 'topaz', 'turquoise', 'jade', 'onyx', 'ivory', 'ebony', 'rose', 'cherry', 'cobalt', 'pearl', 'sienna', 'tan', 'taupe', 'wheat', 'mustard', 'copper', 'bronze', 'brass', 'platinum', 'rose gold', 'champagne', 'blush', 'fawn', 'sage', 'fern', 'moss', 'pine', 'spruce', 'teal blue', 'aqua marine', 'seafoam green', 'mint green', 'lime green', 'chartreuse', 'olive drab', 'khaki green', 'pearl white', 'jet black', 'ruby red', 'sapphire blue', 'emerald green', 'amethyst purple', 'citrine yellow', 'topaz orange', 'turquoise teal', 'opal pink', 'garnet maroon', 'peridot lime', 'aquamarine cyan', 'moonstone silver', 'sunstone gold', 'labradorite gray', 'onyx black', 'malachite green', 'lapis lazuli blue', 'tanzanite purple', 'carnelian red', 'aventurine green', 'rhodonite pink', 'chalcedony blue', 'jasper brown', 'agate gray', 'obsidian black', 'sodalite blue', 'fluorite purple', 'hematite silver', 'pyrite gold', 'serpentine green', 'azurite blue', 'rhodochrosite pink', 'tourmaline multicolor', 'zircon clear', 'spinel red', 'kunzite pink', 'iolite vioconst ', 'chrysoberyl yellow', 'alexandrite green', 'diopside green', 'euclase blue', 'garnet orange', 'kyanite blue', 'lepidolite purple', 'morganite peach', 'prehnite green', 'rutilated quartz gold', 'scapolite yellow', 'sphene green', 'tremolite green', 'vesuvianite green', 'wulfenite orange', 'zincite red', 'zoisite green', 'seraphinite green', 'sugilite purple', 'tiger eye brown', 'unakite green', 'variscite green', 'wulfenite yellow', 'xenotime brown', 'yukonite yellow', 'zincite orange', 'zircon blue', 'zoisite pink', 'serpentine yellow', 'sodalite gray', 'spinel blue', 'sugilite pink', 'tiger eye gold', 'unakite pink', 'variscite blue', 'wulfenite red', 'xenotime yellow', 'yukonite green', 'zincite blue', 'zircon green', 'zoisite blue', 'serpentine blue', 'sodalite pink', 'spinel green', 'sugilite blue', 'tiger eye silver', 'unakite blue', 'variscite pink', 'wulfenite green', 'xenotime pink', 'yukonite blue', 'zincite silver', 'zircon silver', 'zoisite silver', 'serpentine silver', 'sodalite silver', 'spinel silver', 'sugilite silver', 'tiger eye silver', 'unakite silver', 'variscite silver', 'wulfenite silver', 'xenotime silver', 'yukonite silver', 'zincite silver', 'zircon silver', 'zoisite silver', 'serpentine silver', 'sodalite silver', 'spinel silver', 'sugilite silver', 'tiger eye silver', 'unakite silver', 'variscite silver', 'wulfenite silver', 'xenotime silver', 'yukonite silver', 'zincite silver', 'zircon silver', 'zoisite silver', 'serpentine silver', 'sodalite silver', 'spinel silver', 'sugilite silver', 'tiger eye silver', 'unakite silver', 'variscite silver', 'wulfenite silver', 'xenotime silver', 'yukonite silver', 'zincite silver', 'zircon silver', 'zoisite silver', ];


        const  sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL', '4XL', '5XL', '6XL', '7XL', '8XL', '9XL', '10XL', '11XL', '12XL', '13XL', '14XL', '15XL', '16XL', '17XL', '18XL', '19XL', '20XL', '21XL', '22XL', '23XL', '24XL', '25XL', '26XL', '27XL', '28XL', '29XL', '30XL', '31XL', '32XL', '33XL', '34XL', '35XL', '36XL', '37XL', '38XL', '39XL', '40XL', '41XL', '42XL', '43XL', '44XL', '45XL', '46XL', '47XL', '48XL', '49XL', '50XL', '51XL', '52XL', '53XL', '54XL', '55XL', '56XL', '57XL', '58XL', '59XL', '60XL', '61XL', '62XL', '63XL', '64XL', '65XL', '66XL', '67XL', '68XL', '69XL', '70XL', '71XL', '72XL', '73XL', '74XL', '75XL', '76XL', '77XL', '78XL', '79XL', '80XL', '81XL', '82XL', '83XL', '84XL', '85XL', '86XL', '87XL', '88XL', '89XL', '90XL', '91XL', '92XL', '93XL', '94XL', '95XL', '96XL', '97XL', '98XL', '99XL', '100XL', ];


        const  shoe_sizes = ['5', '5.5', '6', '6.5', '7', '7.5', '8', '8.5', '9', '9.5', '10', '10.5', '11', '11.5', '12', '12.5', '13', '13.5', '14', '14.5', '15', '15.5', '16', '16.5', '17', '17.5', '18', '18.5', '19', '19.5', '20', '20.5', '21', '21.5', '22', '22.5', '23', '23.5', '24', '24.5', '25', '25.5', '26', '26.5', '27', '27.5', '28', '28.5', '29', '29.5', '30', '30.5', '31', '31.5', '32', '32.5', '33', '33.5', '34', '34.5', '35', '35.5', '36', '36.5', '37', '37.5', '38', '38.5', '39', '39.5', '40', '40.5', '41', '41.5', '42', '42.5', '43', '43.5', '44', '44.5', '45', '45.5', '46', '46.5', '47', '47.5', '48', '48.5', '49', '49.5', '50', '50.5', '51', '51.5', '52', '52.5', '53', '53.5', '54', '54.5', '55', '55.5', '56', '56.5', '57', '57.5', '58', '58.5', '59', '59.5', '60'];

                </script>
                <div class="form-group">
                    <label>Stock Quantity</label>
                    <input type="number" name="product_count" class="form-control" min="0"
                        value="10">
                </div>
            </div>

            {{-- main image --}}
            <div class="checkout-section">

                <div class="checkout-section-title">Image</div>
                <div class="form-group">
                    <label>Product Image</label>
                    <input type="file" name="product_image" class="form-control" accept="image/*"
                        data-preview="img-preview" style="padding:0.5rem">
                    <img id="img-preview" class="img-preview" alt="Preview">
                    <small style="color:var(--text-muted);font-size:0.72rem;display:block;margin-top:0.4rem">
                        JPEG or PNG · Max 5MB each · First image = cover
                    </small>
                </div>

                <?php if ($isEdit): ?>
                <p style="font-size:0.75rem;color:var(--text-muted)">Upload new images to replace existing ones.</p>
                <?php endif; ?>
            </div>

            {{-- additional images --}}
            <div class="checkout-section">
                    <div class="checkout-section-title">Additional Images</div>
                    <div class="form-group">
                        <label>Product Images</label>
                        <input type="file" name="product_images[]" class="form-control" multiple accept="image/*"
                            data-preview="img-preview-multiple" style="padding:0.5rem">
                        <div id="img-preview-multiple" class="img-preview-multiple"></div>
                        <small style="color:var(--text-muted);font-size:0.72rem;display:block;margin-top:0.4rem">
                            JPEG or PNG · Max 5MB each · First image = cover
                        </small>
                    </div>
            </div>

            {{-- Actions --}}
            <div style="display:flex;flex-direction:column;gap:0.75rem">
                <button type="submit"
                    class="btn btn-primary btn-block"><?= $isEdit ? 'Save Changes' : 'Create Product' ?></button>
                <a href="/admin/products" class="btn btn-ghost btn-block">Cancel</a>
            </div>
        </div>

    </div>
</form>

<x-admin.footer></x-admin.footer>
