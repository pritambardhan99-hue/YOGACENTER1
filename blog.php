<?php
$page_title = "Wellness Blog";
$page_description = "Yoga tips, Ayurvedic remedies and holistic wellness guides from the Chhanda Wellbeing Wish Center team.";
require_once 'includes/header.php';

$posts = [
    ["tag"=>"Yoga","title"=>"5 Morning Asanas to Start Your Day with Energy","excerpt"=>"Discover a simple 15-minute Hatha Yoga sequence recommended by our Acharyas to boost energy and focus every morning.","date"=>"02 Aug 2026","author"=>"Chanda Barat","img"=>"gallery-yogahall.svg"],
    ["tag"=>"Ayurveda","title"=>"Understanding Your Dosha: Vata, Pitta &amp; Kapha","excerpt"=>"Learn how identifying your Ayurvedic body constitution can help you choose the right diet, routine and therapies.","date"=>"22 Jul 2026","author"=>"Dr. Anil Sharma","img"=>"gallery-therapy.svg"],
    ["tag"=>"Meditation","title"=>"A Beginner's Guide to Dhyana Meditation","excerpt"=>"New to meditation? Here is a gentle, step-by-step guide to build a consistent Dhyana practice at home.","date"=>"10 Jul 2026","author"=>"Chanda Wellness Team","img"=>"gallery-garden.svg"],
    ["tag"=>"Nutrition","title"=>"Seasonal Ayurvedic Foods for the Monsoon","excerpt"=>"Monsoon calls for special dietary care. Explore Ayurveda-recommended foods to keep your immunity strong this season.","date"=>"28 Jun 2026","author"=>"Sunita Rawat","img"=>"gallery-spa.svg"],
    ["tag"=>"Yoga","title"=>"Yoga for Working Professionals: Beat Desk Fatigue","excerpt"=>"Simple chair-yoga stretches and Pranayama techniques you can practise right at your office desk.","date"=>"14 Jun 2026","author"=>"Meera Joshi","img"=>"gallery-groupclass.svg"],
    ["tag"=>"Wellness","title"=>"The Healing Power of Panchakarma Detox","excerpt"=>"An inside look at our Panchakarma programme and how this classical detox therapy rejuvenates body and mind.","date"=>"02 Jun 2026","author"=>"Dr. Anil Sharma","img"=>"gallery-retreat.svg"],
];
?>

<section class="page-banner">
  <img src="assets/images/mandala-large.svg" class="mandala-corner tl" alt="">
  <img src="assets/images/mandala-large.svg" class="mandala-corner br" alt="">
  <div class="container">
    <span class="eyebrow">Gyan Aur Sehat</span>
    <h1>Our Wellness Blog</h1>
    <p class="breadcrumb"><a href="home.php">Home</a> / Blog</p>
  </div>
</section>

<section>
  <div class="container">
    <div class="blog-grid">
      <?php foreach ($posts as $i => $post): ?>
        <article class="blog-card" data-aos="fade-up" data-aos-delay="<?php echo ($i % 3) * 100; ?>">
          <div class="blog-thumb"><img src="assets/images/<?php echo $post['img']; ?>" alt="<?php echo strip_tags($post['title']); ?>" style="height:100%;width:100%;object-fit:cover;"></div>
          <div class="blog-body">
            <span class="blog-tag"><?php echo $post['tag']; ?></span>
            <h3><?php echo $post['title']; ?></h3>
            <p style="color:var(--muted);font-size:.94rem;margin-top:10px;"><?php echo $post['excerpt']; ?></p>
            <div class="blog-meta">
              <span><i class="fa-regular fa-calendar"></i> <?php echo $post['date']; ?></span>
              <span><i class="fa-regular fa-user"></i> <?php echo $post['author']; ?></span>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section-alt">
  <div class="container">
    <div class="cta-band" data-aos="zoom-in">
      <div>
        <h2>Never Miss a Wellness Tip</h2>
        <p>Subscribe to our newsletter from the footer below for weekly Ayurveda &amp; Yoga guides.</p>
      </div>
      <a href="index.php#contactForm" class="btn btn-gold"><i class="fa-solid fa-envelope-open-text"></i> Get in Touch</a>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
