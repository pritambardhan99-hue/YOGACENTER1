<footer class="site-footer">
  <svg class="footer-wave" viewBox="0 0 1440 60" preserveAspectRatio="none" style="height:60px;">
    <path fill="#FDE9F1" d="M0,32 C240,64 480,0 720,16 C960,32 1200,64 1440,24 L1440,0 L0,0 Z"></path>
  </svg>

  <div class="container footer-top">
    <div class="footer-grid">

      <div class="footer-about">
        <div class="footer-brand">
          <img src="assets/images/logo-mandala.svg" alt="logo" class="brand-mark">
          <span class="name-en"><?php echo $site_name; ?></span>
        </div>
        <p>A trusted Indian sanctuary for yoga, meditation and Ayurvedic healthcare — nurturing the body, mind and spirit with authentic, time-honoured wellness traditions.</p>
        <div class="footer-social">
          <a href="<?php echo $site_facebook; ?>" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="<?php echo $site_instagram; ?>" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
          <a href="<?php echo $site_youtube; ?>" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
          <a href="https://wa.me/<?php echo $site_whatsapp; ?>" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
        </div>
      </div>

      <div class="footer-col">
        <h4>Quick Links</h4>
        <ul class="footer-links">
          <li><a href="home.php">Home</a></li>
          <li><a href="about.php">About Us</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="products.php">Products</a></li>
          <li><a href="other-business.php">Other Business</a></li>
          <li><a href="blog.php">Blog</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Legal</h4>
        <ul class="footer-links">
          <li><a href="index.php">Contact Us</a></li>
          <li><a href="privacy-policy.php">Privacy Policy</a></li>
          <li><a href="terms-conditions.php">Terms &amp; Conditions</a></li>
          <li><a href="blog.php">Wellness Blog</a></li>
        </ul>
      </div>

      <div class="footer-col">
        <h4>Stay Connected</h4>
        <p style="color:#e4b9cf;font-size:.9rem;margin-bottom:14px;">Subscribe for yoga tips, event updates &amp; seasonal Ayurveda guides.</p>
        <?php if (!empty($newsletter_success)): ?>
          <p style="color:#9be3ab; font-size:.85rem; font-weight:600; margin-bottom:10px;"><i class="fa-solid fa-circle-check"></i> Subscribed! Thank you.</p>
        <?php endif; ?>
        <form class="footer-newsletter" action="index.php#contactForm" method="post">
          <div style="position:absolute; left:-9999px;" aria-hidden="true">
            <input type="text" name="nl_website" tabindex="-1" autocomplete="off">
          </div>
          <input type="email" name="newsletter_email" placeholder="Your email address" required>
          <button type="submit" name="newsletter_submit"><i class="fa-solid fa-paper-plane"></i></button>
        </form>
        <p style="margin-top:10px;color:#c98caa;font-size:.74rem;">By subscribing, you consent to receive occasional emails from us. Unsubscribe anytime — see our <a href="privacy-policy.php" style="color:#e4b9cf;text-decoration:underline;">Privacy Policy</a>.</p>
        <p style="margin-top:18px;color:#e4b9cf;font-size:.85rem;"><i class="fa-solid fa-location-dot" style="color:#D9A94E;margin-right:6px;"></i><?php echo $site_address; ?></p>
      </div>

    </div>
  </div>

  <div class="container footer-bottom">
    <span>&copy; <?php echo $current_year; ?> <?php echo $site_name; ?>. All Rights Reserved.</span>
    <span>Designed with <i class="fa-solid fa-heart" style="color:#D9A94E;"></i> for holistic wellbeing in India.</span>
  </div>
</footer>

<a href="#" class="back-to-top" aria-label="Back to top"><i class="fa-solid fa-arrow-up"></i></a>

<div class="fab-backdrop"></div>
<div class="social-fab">
  <div class="social-fab-menu">
    <a href="tel:<?php echo str_replace(' ','',$site_phone); ?>" class="call-btn" aria-label="Call Us"><i class="fa-solid fa-phone"></i><span class="fab-tooltip">Call Us</span></a>
    <a href="https://wa.me/<?php echo $site_whatsapp; ?>" class="whatsapp-btn" target="_blank" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i><span class="fab-tooltip">WhatsApp</span></a>
    <a href="<?php echo $site_map_link; ?>" class="location-btn" target="_blank" aria-label="Get Directions"><i class="fa-solid fa-location-dot"></i><span class="fab-tooltip">Directions</span></a>
    <a href="<?php echo $site_facebook; ?>" class="facebook-btn" target="_blank" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i><span class="fab-tooltip">Facebook</span></a>
    <a href="<?php echo $site_instagram; ?>" class="instagram-btn" target="_blank" aria-label="Instagram"><i class="fa-brands fa-instagram"></i><span class="fab-tooltip">Instagram</span></a>
    <a href="<?php echo $site_youtube; ?>" class="youtube-btn" target="_blank" aria-label="YouTube"><i class="fa-brands fa-youtube"></i><span class="fab-tooltip">YouTube</span></a>
  </div>
  <button type="button" class="social-fab-toggle" aria-label="Contact &amp; social options" aria-expanded="false">
    <i class="fa-solid fa-share-nodes"></i>
  </button>
</div>

<div class="lightbox">
  <button class="lightbox-close" aria-label="Close">&times;</button>
  <img src="" alt="Preview">
</div>

<!-- Cookie Consent Banner (DPDP Act, 2023) -->
<div class="cookie-banner" id="cookieBanner">
  <div class="cookie-banner-icon"><i class="fa-solid fa-cookie-bite"></i></div>
  <p>We use cookies for essential site functionality and to understand visitor behaviour. Read our <a href="privacy-policy.php">Privacy Policy</a> to learn more about how we handle your personal data under India's DPDP Act.</p>
  <div class="cookie-banner-actions">
    <button type="button" class="cookie-decline" id="cookieDecline">Decline</button>
    <button type="button" class="cookie-accept" id="cookieAccept">Accept</button>
  </div>
</div>

<script src="assets/js/script.js?v=<?php echo $asset_version; ?>"></script>
</body>
</html>
