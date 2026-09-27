<?php
$page_title = "Sessions";
$page_description = "Join Online Yoga Classes (open to Male & Female) or Offline Yoga Classes (Female only) at Chhanda Wellbeing Wish Center.";
require_once 'includes/header.php';
?>

<section class="page-banner">
  <img src="assets/images/mandala-large.svg" class="mandala-corner tl" alt="">
  <img src="assets/images/mandala-large.svg" class="mandala-corner br" alt="">
  <div class="container">
    <span class="eyebrow">Kaksha Vikalp</span>
    <h1>Our Yoga Sessions</h1>
    <p class="breadcrumb"><a href="home.php">Home</a> / Sessions</p>
  </div>
</section>

<section>
  <div class="container">
    <div class="section-title center" data-aos="fade-up">
      <span class="eyebrow">Choose What Suits You</span>
      <h2>Online &amp; Offline Yoga Classes</h2>
      <p class="lead" style="margin-inline:auto;">Practise from the comfort of your home, or join us in person at our Gangajalghati centre — pick the session that fits your life.</p>
    </div>

    <div class="tilt-grid tilt-grid-2col">

      <!-- ONLINE SESSION -->
      <div class="tilt-card" data-aos="fade-right" style="padding:44px 36px;">
        <span class="p-badge" style="position:absolute; top:20px; right:20px; left:auto;">Male &amp; Female</span>
        <div class="tilt-icon"><i class="fa-solid fa-video"></i></div>
        <h3>Online Yoga Class</h3>
        <p>Live, guided yoga sessions streamed straight to your home — open to both men and women. Perfect for working professionals, students and anyone outside Gangajalghati who still wants authentic guidance from our instructors.</p>
        <div class="p-features" style="margin-top:20px;">
          <span><i class="fa-solid fa-check"></i> Open to Male &amp; Female</span>
          <span><i class="fa-solid fa-check"></i> Live via Zoom / Google Meet</span>
          <span><i class="fa-solid fa-check"></i> Morning &amp; Evening Batches</span>
          <span><i class="fa-solid fa-check"></i> Practice From Home</span>
        </div>
        <ul style="margin:22px 0 0 0; color:var(--muted); font-size:.95rem; line-height:1.9;">
          <li><i class="fa-solid fa-clock" style="color:var(--rose); width:18px;"></i> Morning Batch: 6:00 AM – 7:00 AM</li>
          <li><i class="fa-solid fa-clock" style="color:var(--rose); width:18px;"></i> Evening Batch: 6:30 PM – 7:30 PM</li>
          <li><i class="fa-solid fa-calendar-days" style="color:var(--rose); width:18px;"></i> Monday to Saturday</li>
        </ul>
        <a href="index.php#contactForm" class="btn" style="margin-top:26px;"><i class="fa-solid fa-calendar-check"></i> Join Online Class</a>
      </div>

      <!-- OFFLINE SESSION -->
      <div class="tilt-card" data-aos="fade-left" style="padding:44px 36px;">
        <span class="p-badge" style="position:absolute; top:20px; right:20px; left:auto; background:var(--rose);">Female Only</span>
        <div class="tilt-icon"><i class="fa-solid fa-person-praying"></i></div>
        <h3>Offline Yoga Class</h3>
        <p>In-person sessions held at our Gangajalghati centre, reserved exclusively for women — offering a comfortable, private and supportive space to practise with hands-on guidance from Chanda Barat.</p>
        <div class="p-features" style="margin-top:20px;">
          <span><i class="fa-solid fa-check"></i> Female Only Batch</span>
          <span><i class="fa-solid fa-check"></i> In-Person at Our Centre</span>
          <span><i class="fa-solid fa-check"></i> Personal Guidance &amp; Correction</span>
          <span><i class="fa-solid fa-check"></i> Access to Centre Facilities</span>
        </div>
        <ul style="margin:22px 0 0 0; color:var(--muted); font-size:.95rem; line-height:1.9;">
          <li><i class="fa-solid fa-clock" style="color:var(--rose); width:18px;"></i> Morning Batch: 7:00 AM – 8:00 AM</li>
          <li><i class="fa-solid fa-clock" style="color:var(--rose); width:18px;"></i> Evening Batch: 5:00 PM – 6:00 PM</li>
          <li><i class="fa-solid fa-location-dot" style="color:var(--rose); width:18px;"></i> <?php echo $site_address; ?></li>
        </ul>
        <a href="index.php#contactForm" class="btn btn-gold" style="margin-top:26px;"><i class="fa-solid fa-calendar-check"></i> Join Offline Class</a>
      </div>

    </div>
  </div>
</section>

<section class="section-alt">
  <div class="container">
    <div class="cta-band" data-aos="zoom-in">
      <div>
        <h2>Not Sure Which Session Suits You?</h2>
        <p>Speak with our team and we'll recommend the right class for your goals.</p>
      </div>
      <a href="index.php#contactForm" class="btn btn-gold"><i class="fa-solid fa-phone-volume"></i> Talk to Us</a>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
