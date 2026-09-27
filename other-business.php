<?php
$page_title = "Other Business";
$page_description = "Explore other businesses run by the Chanda family, including Barat Mobile.";
require_once 'includes/header.php';

/**
 * OTHER BUSINESS VENTURES
 * Add more shops/ventures here later the same way — each needs an icon
 * (see https://fontawesome.com/search for free icon names), a name and
 * a short description. A Google Map link can be added per-venture using
 * the optional "map" key (see usage further below).
 */
$ventures = [
    [
        "icon" => "fa-mobile-screen-button",
        "name" => "Barat Mobile",
        "desc" => "Our trusted mobile phone &amp; accessories shop — offering the latest smartphones, repairs and accessories under the same Chanda family of businesses.",
        "map"  => "", // Paste your Google Maps embed/share link here later
    ],
];
?>

<section class="page-banner">
  <img src="assets/images/mandala-large.svg" class="mandala-corner tl" alt="">
  <img src="assets/images/mandala-large.svg" class="mandala-corner br" alt="">
  <div class="container">
    <span class="eyebrow">Hamara Parivar</span>
    <h1>Other Businesses Under Chanda Group</h1>
    <p class="breadcrumb"><a href="home.php">Home</a> / Other Business</p>
  </div>
</section>

<section>
  <div class="container">
    <div class="section-title center" data-aos="fade-up">
      <span class="eyebrow">One Family, More Roots</span>
      <h2>Other Businesses We Run</h2>
      <p class="lead" style="margin-inline:auto;">Beyond our wellness centre, the Chanda family also runs the following business.</p>
    </div>

    <div class="tilt-grid tilt-grid-solo">
      <?php foreach ($ventures as $i => $v): ?>
        <div class="tilt-card" data-aos="fade-up" data-aos-delay="<?php echo ($i % 3) * 100; ?>">
          <div class="tilt-icon"><i class="fa-solid <?php echo $v['icon']; ?>"></i></div>
          <h3><?php echo $v['name']; ?></h3>
          <p><?php echo $v['desc']; ?></p>
          <?php if (!empty($v['map'])): ?>
            <a href="<?php echo $v['map']; ?>" target="_blank" class="btn btn-sm btn-outline" style="margin-top:16px;"><i class="fa-solid fa-location-dot"></i> View on Map</a>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
