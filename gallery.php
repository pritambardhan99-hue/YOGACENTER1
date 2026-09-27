<?php
$page_title = "Gallery";
$page_description = "Glimpses of yoga classes, meditation, Ayurvedic therapy and wellness at Chhanda Wellbeing Wish Center.";
require_once 'includes/header.php';

/**
 * AUTOMATIC GALLERY
 * -------------------
 * You do NOT need to edit this file to add photos.
 * Just upload any image file into: assets/images/gallery/
 * It supports every common photo format (JPG, JPEG, PNG, WEBP, GIF, AVIF,
 * SVG) and ANY size/resolution — the page automatically detects new files,
 * gives them a clean title, and crops/fits them neatly into the grid.
 *
 * OPTIONAL: to give a photo a nicer caption or a specific category
 * (yoga / meditation / ayurveda / retreat) instead of the automatic guess,
 * add a line below using the exact uploaded filename:
 */
$gallery_overrides = [
    // "your-photo-filename.jpg" => ["title" => "Sunrise Yoga Session", "cat" => "yoga"],
];

$gallery_dir = __DIR__ . '/assets/images/gallery';
$allowed_ext = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'avif', 'svg'];
$category_keywords = [
    'yoga'      => 'yoga',
    'asana'     => 'yoga',
    'medit'     => 'meditation',
    'dhyana'    => 'meditation',
    'ayurved'   => 'ayurveda',
    'therapy'   => 'ayurveda',
    'spa'       => 'ayurveda',
    'shirodhara'=> 'ayurveda',
    'abhyanga'  => 'ayurveda',
    'retreat'   => 'retreat',
    'himalay'   => 'retreat',
];

$gallery_items = [];
if (is_dir($gallery_dir)) {
    $files = scandir($gallery_dir);
    // Sort newest upload first
    usort($files, function ($a, $b) use ($gallery_dir) {
        $pa = $gallery_dir . '/' . $a;
        $pb = $gallery_dir . '/' . $b;
        if (!file_exists($pa) || !file_exists($pb)) return 0;
        return filemtime($pb) - filemtime($pa);
    });

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $path = $gallery_dir . '/' . $file;
        if (!is_file($path)) continue;

        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed_ext, true)) continue; // skips README.txt etc.

        if (isset($gallery_overrides[$file])) {
            $title = $gallery_overrides[$file]['title'] ?? null;
            $cat   = $gallery_overrides[$file]['cat'] ?? null;
        } else {
            $title = null;
            $cat   = null;
        }

        if (!$title) {
            $name  = pathinfo($file, PATHINFO_FILENAME);
            $name  = preg_replace('/[_\-]+/', ' ', $name);
            $name  = preg_replace('/\s+/', ' ', trim($name));
            $title = ucwords(strtolower($name));
            if ($title === '') { $title = 'Wellness Moment'; }
        }

        if (!$cat) {
            $cat = 'gallery';
            $lower = strtolower($file);
            foreach ($category_keywords as $needle => $mapped) {
                if (strpos($lower, $needle) !== false) { $cat = $mapped; break; }
            }
        }

        $gallery_items[] = ["img" => $file, "cat" => $cat, "title" => $title];
    }
}
?>

<section class="page-banner">
  <img src="assets/images/mandala-large.svg" class="mandala-corner tl" alt="">
  <img src="assets/images/mandala-large.svg" class="mandala-corner br" alt="">
  <div class="container">
    <span class="eyebrow">Tasveer Gallery</span>
    <h1>Our Wellness Gallery</h1>
    <p class="breadcrumb"><a href="home.php">Home</a> / Gallery</p>
  </div>
</section>

<section>
  <div class="container">

    <?php if (empty($gallery_items)): ?>

      <div style="text-align:center; padding:40px 20px 10px;" data-aos="fade-up">
        <i class="fa-regular fa-images" style="font-size:3rem; color:var(--rose); opacity:.4;"></i>
        <h3 style="margin-top:18px;">Photos Coming Soon</h3>
        <p class="lead" style="margin-inline:auto;">Upload your photos into <strong>assets/images/gallery/</strong> and they'll appear here automatically — any format, any size.</p>
      </div>

    <?php else: ?>

      <div class="gallery-grid">
        <?php foreach ($gallery_items as $i => $item): ?>
          <div class="gallery-item" data-cat="<?php echo htmlspecialchars($item['cat']); ?>" data-aos="fade-up" data-aos-delay="<?php echo ($i % 3) * 100; ?>">
            <img src="assets/images/gallery/<?php echo rawurlencode($item['img']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" loading="lazy">
          </div>
        <?php endforeach; ?>
      </div>

    <?php endif; ?>

  </div>
</section>

<section class="section-alt">
  <div class="container">
    <div class="cta-band" data-aos="zoom-in">
      <div>
        <h2>Want a Peaceful Space Like This?</h2>
        <p>Join our next batch and experience it yourself.</p>
      </div>
      <a href="index.php#contactForm" class="btn btn-gold"><i class="fa-solid fa-calendar-check"></i> Enroll Now</a>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
