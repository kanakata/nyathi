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
                    <label>Product Colors</label>
                    <select name="product_color" class="form-control" required>
                        <option value="">Select color…</option>
                        {{-- Backend: render <option> from $categories --}}
                        <option value="red" >red</option>
                        <option value="white" >white</option>
                        <option value="blue" >blue</option>
                        <option value="black"   >black</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Product Sizes</label>
                    <select name="product_size" class="form-control" required>
                        <option value="">Select size…</option>
                        {{-- Backend: render <option> from $categories --}}
                        <option value="XS" >XS</option>
                        <option value="S" >S</option>
                        <option value="M" >M</option>
                        <option value="L" >L</option>
                        <option value="XL" >XL</option>
                        <option value="XXL" >XXL</option>
                        <option value="XXXL" >XXXL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Stock Quantity</label>
                    <input type="number" name="product_count" class="form-control" min="0"
                        value="10">
                </div>
            </div>

            {{-- Images --}}
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
                {{-- <div class="form-group">
                    <label>Product Images</label>
                    <input type="file" name="product_images[]" class="form-control" multiple accept="image/*"
                        data-preview="img-preview" style="padding:0.5rem">
                    <img id="img-preview" class="img-preview" alt="Preview">
                    <small style="color:var(--text-muted);font-size:0.72rem;display:block;margin-top:0.4rem">
                        JPEG or PNG · Max 5MB each · First image = cover
                    </small>
                </div> --}}
                <?php if ($isEdit): ?>
                <p style="font-size:0.75rem;color:var(--text-muted)">Upload new images to replace existing ones.</p>
                <?php endif; ?>
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
