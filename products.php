<?php
$page_title = "Products";
$page_description = "Shop authentic wellness supplements from Chhanda Wellbeing Wish Center — protein, multivitamins, joint support, omega 3 and more.";
require_once 'includes/header.php';

/**
 * PRODUCT CATALOGUE
 * ------------------
 * Add/edit products below. The layout alternates automatically
 * (image-left/text-right, then text-left/image-right, and so on).
 *
 * PHOTOS: Upload your product photos into assets/images/products/
 * then set "img" to the filename — WITH or WITHOUT the extension, either
 * works (e.g. "Premium Protein" or "Premium Protein.jpg" both find the
 * same uploaded file automatically, in any of jpg/jpeg/png/webp/gif/avif).
 * Leave "img" empty ("") to show a neat placeholder until you upload one.
 *
 * IMPORTANT: every product block below needs ALL SIX keys —
 * "img", "icon", "badge", "name", "desc", "features" — even if "img" is
 * filled in. Deleting any of the other lines (as happened with the first
 * product here) causes a PHP "Undefined array key" warning.
 */

/**
 * Finds the actual uploaded photo for a product, even if you typed the name
 * without an extension or in different case. Returns the real filename to
 * use, or "" if no matching photo has been uploaded yet.
 */
function find_product_image($img_field) {
    $dir = __DIR__ . '/assets/images/products';
    if (empty($img_field) || !is_dir($dir)) return '';

    // Defensive guard: reject anything that looks like a path-traversal
    // attempt. Not currently reachable by a visitor (this value only ever
    // comes from the hardcoded $products array below, never from user
    // input), but this keeps the function safe even if that ever changes.
    if (strpos($img_field, '..') !== false || strpos($img_field, '/') !== false || strpos($img_field, '\\') !== false) {
        return '';
    }

    // 1) Exact filename given and it exists — use it directly.
    if (is_file($dir . '/' . $img_field)) return $img_field;

    // 2) Otherwise, search for any file whose name (ignoring extension and
    //    letter case) matches what was typed.
    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'avif'];
    foreach (scandir($dir) as $file) {
        if ($file === '.' || $file === '..') continue;
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed, true)) continue;
        $name = pathinfo($file, PATHINFO_FILENAME);
        if (strcasecmp($name, pathinfo($img_field, PATHINFO_FILENAME)) === 0) return $file;
    }
    return '';
}

$products = [
    [
        "img"      => "Premium Protein",
        "icon"     => "fa-dumbbell",
        "badge"    => "Best Seller",
        "name"     => "Premium Protein",
        "desc"     => "A high-quality protein blend crafted to support muscle recovery, strength and everyday nutrition. Ideal for active adults, yoga practitioners and anyone looking to meet their daily protein needs the natural way.",
        "features" => ["High Protein", "Easy to Digest", "No Added Sugar"],
    ],
    [
        "img"      => "Energy Up (Booster)",
        "icon"     => "fa-bolt",
        "badge"    => "Energy Booster",
        "name"     => "Energy Up (Booster)",
        "desc"     => "A natural energy-boosting formula designed to fight fatigue and keep you active through long, demanding days. A trusted pick for students, professionals and anyone needing an extra push of vitality.",
        "features" => ["Fights Fatigue", "Natural Ingredients", "Daily Vitality"],
    ],
    [
        "img"      => "Multi-Vitamin",
        "icon"     => "fa-capsules",
        "badge"    => "Everyday Essential",
        "name"     => "Multi-Vitamin",
        "desc"     => "A complete daily multi-vitamin formulated to fill common nutritional gaps and support overall immunity, energy and wellbeing — one simple step towards a healthier daily routine.",
        "features" => ["Complete Daily Dose", "Immunity Support", "For All Adults"],
    ],
    [
        "img"      => "Calcium",
        "icon"     => "fa-bone",
        "badge"    => "Bone Care",
        "name"     => "Calcium",
        "desc"     => "A dedicated calcium supplement to support strong bones and healthy joints, especially useful for growing children, active adults and those in their later years.",
        "features" => ["Bone Strength", "Supports Joints", "Suitable for All Ages"],
    ],
    [
        "img"      => "Male Support",
        "icon"     => "fa-mars",
        "badge"    => "Men's Wellness",
        "name"     => "Male Support",
        "desc"     => "A specially formulated supplement to support men's stamina, strength and overall vitality — crafted with natural ingredients rooted in traditional wellness practices.",
        "features" => ["Boosts Stamina", "Natural Formula", "Daily Support"],
    ],
    [
        "img"      => "Joint Health",
        "icon"     => "fa-hand-holding-medical",
        "badge"    => "Mobility Care",
        "name"     => "Joint Health",
        "desc"     => "A targeted supplement to support joint flexibility, comfort and mobility — ideal for those with an active lifestyle or early signs of joint stiffness.",
        "features" => ["Improves Flexibility", "Eases Stiffness", "Long-Term Support"],
    ],
    [
        "img"      => "Omega 3",
        "icon"     => "fa-fish",
        "badge"    => "Heart &amp; Brain",
        "name"     => "Omega 3",
        "desc"     => "A premium Omega 3 supplement to support heart health, brain function and overall wellbeing — an easy daily addition to a balanced, health-conscious lifestyle.",
        "features" => ["Heart Health", "Brain Function", "Pure &amp; Potent"],
    ],
    [
        "img"      => "garcinia",
        "icon"     => "fa-weight-scale",
        "badge"    => "Weight Management",
        "name"     => "Garcinia Lean Supplement",
        "desc"     => "MAYLEEN Garcinia Lean Capsules help you manage a healthy weight as part of an active, healthy lifestyle — a simple daily addition to support your weight management goals alongside a balanced diet and regular exercise.",
        "features" => ["Healthy Weight Management", "For an Active Lifestyle", "Daily Capsule"],
    ],
    [
        "img"      => "nutration",
        "icon"     => "fa-blender",
        "badge"    => "4 Flavours Available",
        "name"     => "Premium Nutritional Shake Mix — Chocolate",
        "desc"     => "MAYLEEN Premium Nutritional Shake Mix is a mouth-watering, tasty shake made with specifically designed essential nutrition to fulfil the body's nutritional requirements — giving you the protein and nutrition you need without overloading on unnecessary fat and calories. Take it once or twice daily along with physical exercise for a fit and active body. Available in four delicious flavours.",
        "features" => ["Delicious Chocolate Flavour", "High Protein Nutrition", "4 Flavours Available", "Low Fat &amp; Calories"],
    ],
    [
        "img"      => "skin booster",
        "icon"     => "fa-hand-sparkles",
        "badge"    => "For Skin Health",
        "name"     => "Skin Booster",
        "desc"     => "MAYLEEN Skin Booster is a delicious orange-flavoured collagen drink enriched with antioxidants and biotin. Collagen offers a host of benefits for skin health, and each serving provides 7g of hydrolyzed fish collagen along with a rich source of vitamins, antioxidants and biotin to support your skin from within.",
        "features" => ["7g Hydrolyzed Fish Collagen", "Orange Flavour", "Rich in Vitamins &amp; Biotin", "Antioxidant Support"],
    ],

];
?>

<section class="page-banner">
  <img src="assets/images/mandala-large.svg" class="mandala-corner tl" alt="">
  <img src="assets/images/mandala-large.svg" class="mandala-corner br" alt="">
  <div class="container">
    <span class="eyebrow">Our Wellness Shop</span>
    <h1>Health &amp; Wellness Products</h1>
    <p class="breadcrumb"><a href="home.php">Home</a> / Products</p>
  </div>
</section>

<section>
  <div class="container">
    <div class="section-title center" data-aos="fade-up">
      <span class="eyebrow">Trusted Supplements for Everyday Wellness</span>
      <h2>Nutrition That Supports Your Whole Body</h2>
    </div>

    <?php foreach ($products as $i => $p): ?>
      <?php $reverse = ($i % 2 == 1); $resolved_img = find_product_image($p['img']); ?>
      <div class="product-row <?php echo $reverse ? 'reverse' : ''; ?>">
        <div class="p-media" data-aos="<?php echo $reverse ? 'fade-left' : 'fade-right'; ?>">
          <span class="p-badge"><?php echo $p['badge']; ?></span>
          <div class="card3d">
            <div class="product-photo-frame">
              <?php if (!empty($resolved_img)): ?>
                <img src="assets/images/products/<?php echo rawurlencode($resolved_img); ?>" alt="<?php echo strip_tags($p['name']); ?>">
              <?php else: ?>
                <i class="fa-solid <?php echo $p['icon']; ?> placeholder-icon"></i>
                <span class="placeholder-text">Product photo coming soon</span>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="p-info" data-aos="<?php echo $reverse ? 'fade-right' : 'fade-left'; ?>">
          <span class="eyebrow">Chanda Wellness Product</span>
          <h3><?php echo $p['name']; ?></h3>
          <p><?php echo $p['desc']; ?></p>
          <div class="p-features">
            <?php foreach ($p['features'] as $f): ?><span><i class="fa-solid fa-check"></i> <?php echo $f; ?></span><?php endforeach; ?>
          </div>
          <a href="index.php#contactForm" class="btn"><i class="fa-solid fa-cart-shopping"></i> Enquire to Order</a>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</section>

<section class="section-alt">
  <div class="container">
    <div class="cta-band" data-aos="zoom-in">
      <div>
        <h2>Looking for a Custom Wellness Kit?</h2>
        <p>Write to us and we'll curate one for your specific needs.</p>
      </div>
      <a href="index.php#contactForm" class="btn btn-gold"><i class="fa-solid fa-gift"></i> Request a Kit</a>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>