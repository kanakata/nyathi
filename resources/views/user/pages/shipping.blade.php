<?php
/**
 * LUXE SHOP — Shipping & Returns Page
 */
$pageTitle  = 'Shipping & Returns — Luxe Shop';
$activePage = '';

?>

<x-user.header></x-user.header>

<div class="page-hero">
  <div class="container">
    <h1>Shipping & Returns</h1>
    <nav class="breadcrumb">
      <a href="/index.php">Home</a><span class="breadcrumb-sep">›</span><span>Shipping & Returns</span>
    </nav>
  </div>
</div>

<section class="section">
  <div class="container" style="max-width:860px">

    <h2 style="margin-bottom:1rem">Shipping Policy</h2>
    <div class="divider left"></div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5px;margin-bottom:3rem">
      <?php
      $methods = [
        ['label'=>'Standard','time'=>'5–7 Business Days','cost'=>'Free over $150 · $9.99 otherwise'],
        ['label'=>'Express', 'time'=>'2–3 Business Days', 'cost'=>'$19.99'],
        ['label'=>'Overnight','time'=>'Next Business Day', 'cost'=>'$34.99'],
      ];
      foreach ($methods as $m): ?>
      <div class="card" style="padding:1.75rem;text-align:center">
        <div class="feature-icon" style="font-size:1.5rem;margin-bottom:1rem">✦</div>
        <h4 style="font-family:var(--font-body);margin-bottom:0.5rem"><?= e($m['label']) ?></h4>
        <p style="font-size:0.8rem;color:var(--gold);margin-bottom:0.25rem"><?= e($m['time']) ?></p>
        <p style="font-size:0.8rem"><?= e($m['cost']) ?></p>
      </div>
      <?php endforeach; ?>
    </div>

    <p style="line-height:1.9;margin-bottom:1rem">Orders placed before 2pm EAT on business days are dispatched the same day. Once shipped, you will receive a tracking link by email. We ship to over 50 countries worldwide; international duties and taxes may apply.</p>

    <hr style="border:none;border-top:1px solid var(--border);margin:3rem 0">

    <h2 style="margin-bottom:1rem">Returns & Exchanges</h2>
    <div class="divider left"></div>
    <p style="line-height:1.9;margin-bottom:1rem">We want you to love every item. If you are not completely satisfied, you may return eligible items within <strong style="color:var(--text)">30 days</strong> of delivery.</p>

    <h3 style="font-size:1.1rem;margin:2rem 0 0.75rem">Eligible for Return</h3>
    <ul style="display:flex;flex-direction:column;gap:0.5rem;padding-left:1.25rem;list-style:disc">
      <li style="color:var(--text-muted);font-size:0.9rem">Unworn and unwashed with all original tags attached</li>
      <li style="color:var(--text-muted);font-size:0.9rem">In original packaging</li>
      <li style="color:var(--text-muted);font-size:0.9rem">Not marked as Final Sale</li>
    </ul>

    <h3 style="font-size:1.1rem;margin:2rem 0 0.75rem">Not Eligible for Return</h3>
    <ul style="display:flex;flex-direction:column;gap:0.5rem;padding-left:1.25rem;list-style:disc">
      <li style="color:var(--text-muted);font-size:0.9rem">Underwear, swimwear, and pierced jewellery (for hygiene reasons)</li>
      <li style="color:var(--text-muted);font-size:0.9rem">Items marked Final Sale</li>
      <li style="color:var(--text-muted);font-size:0.9rem">Items showing signs of wear, washing, or damage</li>
    </ul>

    <h3 style="font-size:1.1rem;margin:2rem 0 0.75rem">How to Return</h3>
    <ol style="display:flex;flex-direction:column;gap:0.75rem;padding-left:1.25rem">
      <li style="color:var(--text-muted);font-size:0.9rem">Log in to <a href="/pages/account.php" style="color:var(--gold)">My Account</a> and navigate to your order.</li>
      <li style="color:var(--text-muted);font-size:0.9rem">Select the item(s) you wish to return and choose a reason.</li>
      <li style="color:var(--text-muted);font-size:0.9rem">Download and print your prepaid return label.</li>
      <li style="color:var(--text-muted);font-size:0.9rem">Pack the items securely and drop off at any designated courier point.</li>
      <li style="color:var(--text-muted);font-size:0.9rem">Your refund will be processed within 3–5 business days of receipt.</li>
    </ol>

    <div style="margin-top:3rem;text-align:center">
      <a href="/pages/contact.php" class="btn btn-outline">Questions? Contact Support</a>
    </div>

  </div>
</section>

<x-user.footer></x-user.footer>
