<?php
/**
 * LUXE SHOP — Terms of Service
 */
$pageTitle  = 'Terms of Service — Luxe Shop';
$activePage = '';

?>
<x-user.header></x-user.header>
<div class="page-hero">
  <div class="container">
    <h1>Terms of Service</h1>
    <nav class="breadcrumb">
      <a href="/index">Home</a><span class="breadcrumb-sep">›</span><span>Terms of Service</span>
    </nav>
  </div>
</div>

<section class="section">
  <div class="container" style="max-width:800px">
    <p style="color:var(--text-muted);margin-bottom:2rem">Last updated: <?= date('F j, Y') ?></p>
    <p style="line-height:1.9;margin-bottom:2rem">By accessing or using Luxe Shop, you agree to be bound by these Terms of Service. Please read them carefully before making a purchase.</p>

    <?php
    $terms = [
      'Use of the Site'             => 'You may use this site for lawful personal purposes only. You must not misuse the site, attempt unauthorised access, or engage in any conduct that could damage or impair the site or other users\' experience.',
      'Account Responsibility'      => 'You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account. Notify us immediately of any unauthorised use.',
      'Product Descriptions'        => 'We strive to display products as accurately as possible. Colours may vary depending on your screen settings. We reserve the right to correct errors in product descriptions or pricing at any time.',
      'Pricing & Payment'           => 'All prices are in USD unless stated otherwise. We reserve the right to change prices without notice. Payment is processed securely at checkout; we do not store full card details.',
      'Order Acceptance'            => 'Placing an order does not constitute a binding contract. We reserve the right to cancel orders due to pricing errors, stock unavailability, or suspected fraud, with full refund.',
      'Intellectual Property'       => 'All content on this site — including text, images, logos, and designs — is owned by Luxe Shop or its licensors and may not be reproduced without written permission.',
      'Limitation of Liability'     => 'To the fullest extent permitted by law, Luxe Shop shall not be liable for indirect, incidental, or consequential damages arising from your use of the site or products purchased.',
      'Governing Law'               => 'These terms are governed by the laws of Kenya. Any disputes shall be subject to the exclusive jurisdiction of the courts of Nairobi.',
      'Changes to Terms'            => 'We may update these terms at any time. Continued use of the site after changes constitutes acceptance of the new terms.',
    ];
    foreach ($terms as $title => $body): ?>
    <div style="margin-bottom:2.5rem">
      <h3 style="margin-bottom:0.75rem;color:var(--gold)"><?= e($title) ?></h3>
      <p style="line-height:1.9"><?= e($body) ?></p>
    </div>
    <?php endforeach; ?>

    <div style="margin-top:3rem;padding:1.5rem;border:1px solid var(--border);border-radius:var(--radius-md)">
      <p style="font-size:0.85rem;line-height:1.8">
        Questions about these terms? <a href="/contact" style="color:var(--gold)">Contact us</a> and we'll be happy to help.
      </p>
    </div>
  </div>
</section>

<x-user.footer></x-user.footer>
