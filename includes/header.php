<?php require_once __DIR__ . '/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo isset($page_title) ? $page_title . " | " . $site_name : $site_name; ?></title>
<meta name="description" content="<?php echo isset($page_description) ? $page_description : 'Chhanda Wellbeing Wish Center — a trusted Indian yoga, meditation, ayurveda and holistic healthcare center offering yoga classes, wellness therapies and natural products.'; ?>">
<link rel="icon" type="image/svg+xml" href="assets/images/favicon.svg">

<!-- Google Fonts: Indian-flavoured display + friendly body font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Yatra+One&family=Mukta:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<!-- Font Awesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link rel="stylesheet" href="assets/css/style.css?v=<?php echo $asset_version; ?>">
</head>
<body>

<header class="site-header">
  <div class="topbar">
    <div class="container">
      <div>
        <span><i class="fa-solid fa-phone"></i><a href="tel:<?php echo str_replace(' ','',$site_phone); ?>"><?php echo $site_phone; ?></a></span>
        <span><i class="fa-solid fa-envelope"></i><a href="mailto:<?php echo $site_email; ?>"><?php echo $site_email; ?></a></span>
      </div>
      <div>
        <span><i class="fa-solid fa-location-dot"></i>Gangajalghati, West Bengal</span>
        <span><i class="fa-solid fa-clock"></i>Mon–Sat 6AM–8PM</span>
      </div>
    </div>
  </div>

  <div class="container navwrap">
    <a href="home.php" class="brand">
      <img src="assets/images/logo-mandala.svg" alt="<?php echo $site_name; ?> logo" class="brand-mark">
      <span class="brand-text">
        <span class="name-en"><?php echo $site_name; ?></span>
        <span class="name-tag"><?php echo $site_tagline; ?></span>
      </span>
    </a>

    <nav class="main-nav">
      <ul>
        <?php foreach ($nav_links as $label => $file): ?>
          <li><a href="<?php echo $file; ?>" class="<?php echo is_active($file) ? 'active' : ''; ?>"><?php echo $label; ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <div class="nav-cta">
      <a href="index.php#contactForm" class="btn btn-sm"><i class="fa-solid fa-spa"></i> <span>Book a Session</span></a>
      <button class="hamburger" aria-label="Menu" aria-expanded="false"><span></span><span></span><span></span></button>
    </div>
  </div>
</header>
