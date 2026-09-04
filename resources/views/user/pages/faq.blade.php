<?php
/**
 * LUXE SHOP — FAQ Page
 */
$pageTitle  = 'Frequently Asked Questions — Luxe Shop';
$activePage = '';

$faqs = [
  'Orders & Shipping' => [
    ['q'=>'How long does shipping take?',         'a'=>'Standard shipping takes 5–7 business days. Express shipping (2–3 days) is also available at checkout. Free shipping applies to all orders over $150.'],
    ['q'=>'Do you ship internationally?',          'a'=>'Yes! We ship to over 50 countries. International shipping rates and estimated delivery times are calculated at checkout.'],
    ['q'=>'Can I track my order?',                 'a'=>'Absolutely. Once your order ships you will receive a tracking number by email. You can also view your order status in My Account.'],
    ['q'=>'Can I change or cancel my order?',      'a'=>'Orders can be modified or cancelled within 1 hour of placement. After that, please contact our support team as soon as possible.'],
  ],
  'Returns & Exchanges' => [
    ['q'=>'What is your return policy?',           'a'=>'We accept returns within 30 days of delivery. Items must be unworn, unwashed, and in original packaging with all tags attached.'],
    ['q'=>'How do I start a return?',              'a'=>'Log into My Account, go to Order History, select the order, and click "Return Items". We\'ll email you a prepaid return label.'],
    ['q'=>'How long do refunds take?',             'a'=>'Once we receive your return, refunds are processed within 3–5 business days back to your original payment method.'],
  ],
  'Products & Sizing' => [
    ['q'=>'How do I find my size?',                'a'=>'Each product page includes a detailed size guide. If you\'re between sizes, we generally recommend sizing up for outerwear and sizing down for fitted tops.'],
    ['q'=>'Are your products sustainable?',        'a'=>'We prioritise sustainable materials including organic cotton, recycled fibres, and responsibly sourced wool. Each product listing details its material composition.'],
  ],
  'Payments & Security' => [
    ['q'=>'What payment methods do you accept?',   'a'=>'We accept Visa, Mastercard, PayPal, Stripe, and M-Pesa. All payments are processed through encrypted, PCI-compliant gateways.'],
    ['q'=>'Is my payment information secure?',     'a'=>'Yes. We never store your full card details. All transactions are encrypted using TLS and processed by certified payment partners.'],
  ],
];


?>

<x-user.header></x-user.header>

<div class="page-hero">
  <div class="container">
    <h1>Frequently Asked Questions</h1>
    <nav class="breadcrumb">
      <a href="/index.php">Home</a>
      <span class="breadcrumb-sep">›</span>
      <span>FAQ</span>
    </nav>
  </div>
</div>

<section class="section">
  <div class="container" style="max-width:800px">
    <?php foreach ($faqs as $group => $items): ?>
    <div style="margin-bottom:3.5rem">
      <h2 style="font-size:1.4rem;margin-bottom:1.5rem;color:var(--gold)"><?= e($group) ?></h2>
      <div style="display:flex;flex-direction:column;gap:1px">
        <?php foreach ($items as $faq): ?>
        <details class="card" style="padding:1.25rem 1.5rem;cursor:pointer">
          <summary style="font-family:var(--font-display);font-size:1rem;list-style:none;display:flex;justify-content:space-between;align-items:center;color:var(--text)">
            <?= e($faq['q']) ?>
            <span style="color:var(--gold);font-size:1.2rem;transition:transform 0.3s">+</span>
          </summary>
          <p style="margin-top:1rem;line-height:1.8"><?= e($faq['a']) ?></p>
        </details>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>

    <div style="text-align:center;padding:2rem;border:1px solid var(--border);border-radius:var(--radius-md)">
      <h3 style="margin-bottom:0.5rem">Still have questions?</h3>
      <p style="margin-bottom:1.5rem">Our support team is happy to help.</p>
      <a href="/pages/contact.php" class="btn btn-primary">Contact Us</a>
    </div>
  </div>
</section>

<style>
details[open] summary span { transform: rotate(45deg); display:inline-block; }
details summary::-webkit-details-marker { display:none; }
</style>

<x-user.footer></x-user.footer>
