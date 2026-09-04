<?php
/**
 * LUXE SHOP — Admin: Settings
 */
$adminTitle   = 'Settings';
$adminSection = 'settings';

include __DIR__ . '/../includes/admin-header.php';
?>

<form method="POST" action="/admin/pages/settings-save.php">

  <!-- General -->
  <div class="checkout-section" style="max-width:760px;margin-bottom:1.5rem">
    <div class="checkout-section-title">General Settings</div>
    <div class="form-group">
      <label>Store Name</label>
      <input type="text" name="store_name" class="form-control" value="Luxe Shop">
    </div>
    <div class="form-group">
      <label>Store Email</label>
      <input type="email" name="store_email" class="form-control" value="hello@luxeshop.com">
    </div>
    <div class="form-group">
      <label>Store Phone</label>
      <input type="tel" name="store_phone" class="form-control" value="+254 700 000 000">
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>Currency</label>
        <select name="currency" class="form-control">
          <option value="USD" selected>USD ($)</option>
          <option value="KES">KES (KSh)</option>
          <option value="EUR">EUR (€)</option>
          <option value="GBP">GBP (£)</option>
        </select>
      </div>
      <div class="form-group">
        <label>Timezone</label>
        <select name="timezone" class="form-control">
          <option value="Africa/Nairobi" selected>Africa/Nairobi (EAT)</option>
          <option value="UTC">UTC</option>
          <option value="Europe/London">Europe/London</option>
        </select>
      </div>
    </div>
  </div>

  <!-- Shipping -->
  <div class="checkout-section" style="max-width:760px;margin-bottom:1.5rem">
    <div class="checkout-section-title">Shipping Settings</div>
    <div class="form-row">
      <div class="form-group">
        <label>Free Shipping Threshold ($)</label>
        <input type="number" name="free_shipping_threshold" class="form-control" value="150" step="0.01">
      </div>
      <div class="form-group">
        <label>Default Shipping Cost ($)</label>
        <input type="number" name="default_shipping" class="form-control" value="9.99" step="0.01">
      </div>
    </div>
    <div class="form-group">
      <label>Express Shipping Cost ($)</label>
      <input type="number" name="express_shipping" class="form-control" value="19.99" step="0.01">
    </div>
  </div>

  <!-- Email -->
  <div class="checkout-section" style="max-width:760px;margin-bottom:1.5rem">
    <div class="checkout-section-title">Email / SMTP Settings</div>
    <div class="form-row">
      <div class="form-group">
        <label>SMTP Host</label>
        <input type="text" name="smtp_host" class="form-control" placeholder="smtp.mailtrap.io">
      </div>
      <div class="form-group">
        <label>SMTP Port</label>
        <input type="number" name="smtp_port" class="form-control" placeholder="587">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group">
        <label>SMTP Username</label>
        <input type="text" name="smtp_user" class="form-control">
      </div>
      <div class="form-group">
        <label>SMTP Password</label>
        <input type="password" name="smtp_pass" class="form-control">
      </div>
    </div>
  </div>

  <!-- Appearance -->
  <div class="checkout-section" style="max-width:760px;margin-bottom:1.5rem">
    <div class="checkout-section-title">Appearance</div>
    <div class="form-group">
      <label>Announcement Bar Text</label>
      <input type="text" name="announcement" class="form-control" value="Free shipping on orders over $150 | New arrivals every week">
    </div>
    <div style="display:flex;align-items:center;gap:0.5rem;margin-bottom:1rem">
      <input type="checkbox" id="maintenance" name="maintenance" style="accent-color:var(--gold)">
      <label for="maintenance" style="font-size:0.85rem;cursor:pointer">Enable Maintenance Mode</label>
    </div>
  </div>

  <button type="submit" class="btn btn-primary">Save Settings</button>

</form>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
