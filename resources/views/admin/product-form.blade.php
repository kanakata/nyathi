<?php

/**
 * LUXE SHOP — Admin: Add / Edit Product Form
 */
// require_once __DIR__ . '/../../includes/config';
// if (!isAdmin()) redirect('/auth/login');

$isEdit = isset($_GET['id']);
$adminTitle   = $isEdit ? 'Edit Product' : 'Add Product';
$adminSection = 'products';

// Backend: if ($isEdit) $product = $db->fetchProduct($_GET['id']);
$product = $isEdit ? [
    'id' => 1,
    'name' => 'Cashmere Blend Coat',
    'slug' => 'cashmere-blend-coat',
    'price' => 389,
    'old_price' => 520,
    'category_id' => 1,
    'description' => 'A masterwork in refined tailoring.',
    'sku' => 'LC-OC-001',
    'stock' => 8,
    'weight' => 1.2,
    'status' => 'active',
    'badge' => 'sale',
    'featured' => true,
    'sizes' => 'XS,S,M,L,XL',
    'colors' => 'Camel,Black,Ivory',
    'meta_title' => '',
    'meta_desc' => '',
] : [];


?>
<x-admin.header></x-admin.header>
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
    <a href="/admin/products" class="btn btn-ghost btn-sm">← Back to Products</a>
    <?php if ($isEdit): ?>
        <a href="/product?slug=<?= urlencode($product['slug']) ?>" target="_blank" class="btn btn-ghost btn-sm">View Live →</a>
    <?php endif; ?>
</div>

<form method="POST" action="/admin/pages/product-save" enctype="multipart/form-data">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= e($product['id']) ?>">
    <?php endif; ?>

    <div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start">

        <!-- LEFT -->
        <div>
            <!-- Basic Info -->
            <div class="checkout-section">
                <div class="checkout-section-title">Product Information</div>
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="name" class="form-control" required data-maxlength="120"
                        value="<?= e($product['name'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Slug (URL)</label>
                    <input type="text" name="slug" class="form-control"
                        value="<?= e($product['slug'] ?? '') ?>" placeholder="auto-generated from name">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="5"
                        data-maxlength="2000"><?= e($product['description'] ?? '') ?></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>SKU</label>
                        <input type="text" name="sku" class="form-control" value="<?= e($product['sku'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>Weight (kg)</label>
                        <input type="number" name="weight" class="form-control" step="0.1" min="0"
                            value="<?= e($product['weight'] ?? '') ?>">
                    </div>
                </div>
            </div>

            <!-- Pricing -->
            <div class="checkout-section">
                <div class="checkout-section-title">Pricing</div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Price ($)</label>
                        <input type="number" name="price" class="form-control" step="0.01" min="0" required
                            value="<?= e($product['price'] ?? '') ?>">
                    </div>
                    <div class="form-group">
                        <label>Compare-at Price ($) <small style="color:var(--text-muted)">(optional)</small></label>
                        <input type="number" name="old_price" class="form-control" step="0.01" min="0"
                            value="<?= e($product['old_price'] ?? '') ?>">
                    </div>
                </div>
            </div>

            <!-- Variants -->
            <div class="checkout-section">
                <div class="checkout-section-title">Variants</div>
                <div class="form-group">
                    <label>Sizes <small style="color:var(--text-muted)">(comma-separated)</small></label>
                    <input type="text" name="sizes" class="form-control" placeholder="XS,S,M,L,XL"
                        value="<?= e($product['sizes'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Colours <small style="color:var(--text-muted)">(comma-separated)</small></label>
                    <input type="text" name="colors" class="form-control" placeholder="Black,White,Camel"
                        value="<?= e($product['colors'] ?? '') ?>">
                </div>
            </div>

            <!-- SEO -->
            <div class="checkout-section">
                <div class="checkout-section-title">SEO (optional)</div>
                <div class="form-group">
                    <label>Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" data-maxlength="60"
                        value="<?= e($product['meta_title'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label>Meta Description</label>
                    <textarea name="meta_desc" class="form-control" rows="2"
                        data-maxlength="160"><?= e($product['meta_desc'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <!-- RIGHT -->
        <div>
            <!-- Status -->
            <div class="checkout-section">
                <div class="checkout-section-title">Status & Visibility</div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" <?= ($product['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="draft" <?= ($product['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft</option>
                        <option value="archived" <?= ($product['status'] ?? '') === 'archived' ? 'selected' : '' ?>>Archived</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Badge</label>
                    <select name="badge" class="form-control">
                        <option value="">None</option>
                        <option value="new" <?= ($product['badge'] ?? '') === 'new' ? 'selected' : '' ?>>New</option>
                        <option value="sale" <?= ($product['badge'] ?? '') === 'sale' ? 'selected' : '' ?>>Sale</option>
                        <option value="sold" <?= ($product['badge'] ?? '') === 'sold' ? 'selected' : '' ?>>Sold Out</option>
                    </select>
                </div>
                <div style="display:flex;align-items:center;gap:0.5rem">
                    <input type="checkbox" id="featured" name="featured" value="1"
                        <?= ($product['featured'] ?? false) ? 'checked' : '' ?> style="accent-color:var(--gold)">
                    <label for="featured" style="font-size:0.85rem;cursor:pointer">Feature on Homepage</label>
                </div>
            </div>

            <!-- Category -->
            <div class="checkout-section">
                <div class="checkout-section-title">Organisation</div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select category…</option>
                        <!-- Backend: render <option> from $categories -->
                        <option value="1" <?= ($product['category_id'] ?? 0) == 1 ? 'selected' : '' ?>>Outerwear</option>
                        <option value="2" <?= ($product['category_id'] ?? 0) == 2 ? 'selected' : '' ?>>Dresses</option>
                        <option value="3" <?= ($product['category_id'] ?? 0) == 3 ? 'selected' : '' ?>>Accessories</option>
                        <option value="4" <?= ($product['category_id'] ?? 0) == 4 ? 'selected' : '' ?>>Bottoms</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Stock Quantity</label>
                    <input type="number" name="stock" class="form-control" min="0"
                        value="<?= e($product['stock'] ?? 0) ?>">
                </div>
            </div>

            <!-- Images -->
            <div class="checkout-section">
                <div class="checkout-section-title">Images</div>
                <div class="form-group">
                    <label>Product Images</label>
                    <input type="file" name="images[]" class="form-control" multiple accept="image/*"
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

            <!-- Actions -->
            <div style="display:flex;flex-direction:column;gap:0.75rem">
                <button type="submit" class="btn btn-primary btn-block"><?= $isEdit ? 'Save Changes' : 'Create Product' ?></button>
                <a href="/admin/products" class="btn btn-ghost btn-block">Cancel</a>
            </div>
        </div>

    </div>
</form>

<x-admin.footer></x-admin.footer>
