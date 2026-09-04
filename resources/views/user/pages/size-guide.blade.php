<?php
/**
 * LUXE SHOP — Size Guide Page
 */
$pageTitle  = 'Size Guide — Luxe Shop';
$activePage = '';


?>

<x-user.header></x-user.header>

<div class="page-hero">
  <div class="container">
    <h1>Size Guide</h1>
    <nav class="breadcrumb">
      <a href="/index.php">Home</a><span class="breadcrumb-sep">›</span><span>Size Guide</span>
    </nav>
  </div>
</div>

<section class="section">
  <div class="container" style="max-width:900px">
    <div class="section-header">
      <h2>Find Your Perfect Fit</h2>
      <div class="divider"></div>
      <p>All measurements are in centimetres unless otherwise stated. When between sizes, we recommend sizing up.</p>
    </div>

    <!-- Women's -->
    <h3 style="margin-bottom:1rem;color:var(--gold)">Women's Clothing</h3>
    <div style="overflow-x:auto;margin-bottom:3rem">
      <table class="orders-table" style="min-width:600px">
        <thead>
          <tr>
            <th>Size</th><th>EU</th><th>UK</th><th>Bust (cm)</th><th>Waist (cm)</th><th>Hips (cm)</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $womenSizes = [
            ['XS','32','6','80–83','60–63','86–89'],
            ['S', '34','8','84–87','64–67','90–93'],
            ['M', '36','10','88–91','68–71','94–97'],
            ['L', '38','12','92–95','72–75','98–101'],
            ['XL','40','14','96–99','76–79','102–105'],
            ['XXL','42','16','100–105','80–85','106–111'],
          ];
          foreach ($womenSizes as $s): ?>
          <tr>
            <td><strong><?= $s[0] ?></strong></td>
            <td><?= $s[1] ?></td><td><?= $s[2] ?></td>
            <td><?= $s[3] ?></td><td><?= $s[4] ?></td><td><?= $s[5] ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- Men's -->
    <h3 style="margin-bottom:1rem;color:var(--gold)">Men's Clothing</h3>
    <div style="overflow-x:auto;margin-bottom:3rem">
      <table class="orders-table" style="min-width:600px">
        <thead>
          <tr>
            <th>Size</th><th>EU</th><th>UK</th><th>Chest (cm)</th><th>Waist (cm)</th><th>Hips (cm)</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $menSizes = [
            ['XS','44','34','84–87','70–73','86–89'],
            ['S', '46','36','88–91','74–77','90–93'],
            ['M', '48','38','92–95','78–81','94–97'],
            ['L', '50','40','96–99','82–85','98–101'],
            ['XL','52','42','100–104','86–90','102–106'],
            ['XXL','54','44','105–109','91–95','107–111'],
          ];
          foreach ($menSizes as $s): ?>
          <tr>
            <td><strong><?= $s[0] ?></strong></td>
            <td><?= $s[1] ?></td><td><?= $s[2] ?></td>
            <td><?= $s[3] ?></td><td><?= $s[4] ?></td><td><?= $s[5] ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- How to Measure -->
    <div class="card" style="padding:2rem">
      <h3 style="margin-bottom:1.25rem">How to Measure</h3>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.5rem">
        <?php
        $measures = [
          ['Bust / Chest','Measure around the fullest part of your chest, keeping the tape parallel to the floor.'],
          ['Waist','Measure around your natural waist — the narrowest point, usually just above your navel.'],
          ['Hips','Stand with feet together and measure around the fullest part of your hips and seat.'],
        ];
        foreach ($measures as $m): ?>
        <div>
          <h4 style="font-family:var(--font-body);font-size:0.82rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:var(--gold);margin-bottom:0.5rem"><?= $m[0] ?></h4>
          <p style="font-size:0.85rem;line-height:1.7"><?= $m[1] ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <p style="text-align:center;margin-top:2rem;font-size:0.85rem">
      Still unsure? <a href="/pages/contact.php" style="color:var(--gold)">Contact our stylists</a> for personalised advice.
    </p>
  </div>
</section>

<x-user.footer></x-user.footer>
