<?php
$page_title = "Contact Us";
$page_description = "Get in touch with Chhanda Wellbeing Wish Center — visit our Gangajalghati centre or book your free yoga & Ayurveda consultation today.";

require_once 'includes/config.php';

// ---------- Contact form handler ----------
$form_success = false;
$form_error   = "";

/**
 * Strips carriage-return/line-feed characters from a string. Used before
 * putting any user-submitted value into an email subject or header, so a
 * malicious multi-line input can never inject extra email headers
 * (e.g. a fake "Bcc:" line) — a classic email header injection attack.
 */
function strip_header_injection($value) {
    return str_replace(["\r", "\n", "%0a", "%0d"], '', (string) $value);
}

/**
 * Neutralises CSV formula injection. If a value starts with =, +, - or @,
 * spreadsheet apps like Excel/Google Sheets can interpret it as a formula
 * when the file is later opened — which can be abused to run commands or
 * exfiltrate data. Prefixing with a single quote stops that, while the
 * text itself still displays normally in the spreadsheet.
 */
function csv_safe($value) {
    $value = (string) $value;
    if (preg_match('/^[=+\-@]/', $value)) {
        return "'" . $value;
    }
    return $value;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    // Honeypot: a hidden field real visitors never see or fill in. If it
    // has a value, the submission came from an automated bot — silently
    // drop it without an error, so the bot thinks it worked and moves on.
    $is_bot = !empty($_POST['website']);

    $name    = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
    $email   = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $phone   = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS));
    $service = trim(filter_input(INPUT_POST, 'service', FILTER_SANITIZE_SPECIAL_CHARS));
    $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS));
    $consent = isset($_POST['consent']) && $_POST['consent'] === 'yes';

    // Defensive hardening regardless of the sanitize filter above: make
    // sure nothing going into the email subject/headers can contain a
    // line break.
    $name    = strip_header_injection($name);
    $service = strip_header_injection($service);

    if ($is_bot) {
        // Pretend success so the bot doesn't retry or probe further.
        $form_success = true;
    } elseif (empty($name) || empty($email) || empty($message)) {
        $form_error = "Please fill in your name, email and message.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $form_error = "Please enter a valid email address.";
    } elseif (!$consent) {
        // DPDP Act, 2023 requires free, specific, informed consent via a clear
        // affirmative action before we may process personal data — so the form
        // cannot be submitted without this box being explicitly checked.
        $form_error = "Please accept the Privacy Policy to submit this form (required under India's DPDP Act).";
    } else {
        // ---- Method 1: Try to email the enquiry (needs SMTP/mail configured on the live server) ----
        $to      = $site_email;
        $subject = "New Enquiry from Website — " . $name;
        $body    = "Name: $name\nEmail: $email\nPhone: $phone\nService Interested In: $service\nConsent Given: Yes (" . date('d-M-Y H:i:s') . ")\n\nMessage:\n$message";
        $headers = "From: " . $site_email . "\r\nReply-To: $email\r\n";
        @mail($to, $subject, $body, $headers);

        // ---- Method 2 (reliable backup): Save every enquiry into a CSV file on the server ----
        // Open this file anytime in Excel/Google Sheets to see all enquiries —
        // works even if email sending is not configured on your hosting.
        // A "Consent Given" record is kept for each entry, so you can
        // demonstrate DPDP Act consent compliance if ever required.
        $data_dir  = __DIR__ . '/data';
        $csv_file  = $data_dir . '/contact-submissions.csv';
        if (!is_dir($data_dir)) { @mkdir($data_dir, 0755, true); }
        $is_new = !file_exists($csv_file);
        if ($fp = @fopen($csv_file, 'a')) {
            if ($is_new) {
                fputcsv($fp, ['Date/Time', 'Name', 'Email', 'Phone', 'Service Interested In', 'Message', 'Consent Given']);
            }
            fputcsv($fp, [
                date('d-M-Y H:i:s'),
                csv_safe($name),
                csv_safe($email),
                csv_safe($phone),
                csv_safe($service),
                csv_safe($message),
                'Yes',
            ]);
            fclose($fp);
        }

        $form_success = true;
    }
}

// ---------- Newsletter subscription handler (footer form, all pages post here) ----------
$newsletter_success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newsletter_submit'])) {
    $nl_is_bot = !empty($_POST['nl_website']);
    $nl_email = trim(filter_input(INPUT_POST, 'newsletter_email', FILTER_SANITIZE_EMAIL));
    if ($nl_is_bot) {
        $newsletter_success = true; // pretend success, drop silently
    } elseif (!empty($nl_email) && filter_var($nl_email, FILTER_VALIDATE_EMAIL)) {
        // The act of submitting this single-field opt-in form is the affirmative
        // consent action (DPDP Act) for receiving the wellness newsletter — the
        // purpose is disclosed directly beside the form, and every subscriber
        // can unsubscribe at any time by emailing us.
        $data_dir = __DIR__ . '/data';
        $nl_file  = $data_dir . '/newsletter-subscribers.csv';
        if (!is_dir($data_dir)) { @mkdir($data_dir, 0755, true); }
        $is_new = !file_exists($nl_file);
        if ($fp = @fopen($nl_file, 'a')) {
            if ($is_new) { fputcsv($fp, ['Date/Time', 'Email', 'Consent Given']); }
            fputcsv($fp, [date('d-M-Y H:i:s'), csv_safe($nl_email), 'Yes']);
            fclose($fp);
        }
        $newsletter_success = true;
    }
}

require_once 'includes/header.php';
?>

<section class="page-banner">
  <img src="assets/images/mandala-large.svg" class="mandala-corner tl" alt="">
  <img src="assets/images/mandala-large.svg" class="mandala-corner br" alt="">
  <div class="container">
    <span class="eyebrow">Ham Se Judiye</span>
    <h1>Contact Chhanda Wellbeing Wish Center</h1>
    <p class="breadcrumb"><a href="home.php">Home</a> / Contact Us</p>
  </div>
</section>

<section id="contactForm">
  <div class="container contact-wrap">

    <div class="contact-info-card" data-aos="fade-right">
      <img src="assets/images/mandala-large.svg" alt="" style="position:absolute;width:260px;opacity:.08;top:-60px;right:-60px;">
      <h3>Let's Connect</h3>
      <p class="sub">हमसे संपर्क करें</p>

      <div class="contact-info-item">
        <i class="fa-solid fa-location-dot"></i>
        <div><strong>Visit Us</strong><span><?php echo $site_address; ?></span><br><a href="<?php echo $site_map_link; ?>" target="_blank" style="color:var(--gold-light); font-weight:600; font-size:.85rem;"><i class="fa-solid fa-diamond-turn-right"></i> Get Directions</a></div>
      </div>
      <div class="contact-info-item">
        <i class="fa-solid fa-phone"></i>
        <div><strong>Call Us</strong><span><a href="tel:<?php echo str_replace(' ','',$site_phone); ?>"><?php echo $site_phone; ?></a></span></div>
      </div>
      <div class="contact-info-item">
        <i class="fa-solid fa-envelope"></i>
        <div><strong>Email Us</strong><span><a href="mailto:<?php echo $site_email; ?>"><?php echo $site_email; ?></a></span></div>
      </div>
      <div class="contact-info-item">
        <i class="fa-solid fa-clock"></i>
        <div><strong>Working Hours</strong><span><?php echo $site_hours; ?></span></div>
      </div>

      <div class="social-row">
        <a href="<?php echo $site_facebook; ?>"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="<?php echo $site_instagram; ?>"><i class="fa-brands fa-instagram"></i></a>
        <a href="<?php echo $site_youtube; ?>"><i class="fa-brands fa-youtube"></i></a>
        <a href="https://wa.me/<?php echo $site_whatsapp; ?>"><i class="fa-brands fa-whatsapp"></i></a>
      </div>
    </div>

    <div class="form-card" data-aos="fade-left">
      <span class="eyebrow">Book a Free Consultation</span>
      <h2 style="margin-bottom:20px;">Send Us a Message</h2>

      <?php if ($form_success): ?>
        <div class="alert-success"><i class="fa-solid fa-circle-check"></i> Thank you! Your message has been received. Our wellness team will contact you shortly. 🙏</div>
      <?php elseif ($form_error): ?>
        <div class="alert-success" style="background:#fbe7e7;border-color:#eab6b6;color:#7a2020;"><i class="fa-solid fa-triangle-exclamation"></i> <?php echo $form_error; ?></div>
      <?php endif; ?>

      <form id="contactForm" method="post" action="index.php#contactForm">
        <!-- Honeypot field for spam bots — hidden from real visitors via CSS,
             and skipped by screen readers via aria-hidden/tabindex. A human
             will never fill this in; a bot filling every field will. -->
        <div style="position:absolute; left:-9999px; top:-9999px;" aria-hidden="true">
          <label for="website">Leave this field empty</label>
          <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
        </div>
        <div class="form-row">
          <div class="field">
            <label for="name">Full Name *</label>
            <input type="text" id="name" name="name" placeholder="Your good name" required>
          </div>
          <div class="field">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" placeholder="+91 90000 00000">
          </div>
        </div>
        <div class="form-row">
          <div class="field">
            <label for="email">Email Address *</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required>
          </div>
          <div class="field">
            <label for="service">Interested In</label>
            <select id="service" name="service">
              <option>Yoga Classes</option>
              <option>Ayurvedic Therapy</option>
              <option>Meditation Sessions</option>
              <option>Wellness Products</option>
              <option>Other Business Enquiry</option>
            </select>
          </div>
        </div>
        <div class="field">
          <label for="message">Your Message *</label>
          <textarea id="message" name="message" rows="5" placeholder="Tell us how we can help you..." required></textarea>
        </div>
        <div class="field consent-field">
          <label class="consent-check">
            <input type="checkbox" id="consent" name="consent" value="yes" required>
            <span>I consent to <?php echo $site_name; ?> collecting and processing my personal data submitted above, solely to respond to my enquiry, in accordance with the <a href="privacy-policy.php" target="_blank">Privacy Policy</a> and India's Digital Personal Data Protection Act, 2023. *</span>
          </label>
        </div>
        <button type="submit" name="contact_submit" class="btn"><i class="fa-solid fa-paper-plane"></i> Send Message</button>
        <p class="form-note">By submitting, you also agree to our <a href="terms-conditions.php">Terms &amp; Conditions</a>. You may withdraw consent anytime — see our <a href="privacy-policy.php">Privacy Policy</a>.</p>
      </form>
    </div>
  </div>

  <div class="container">
    <div class="map-embed" data-aos="fade-up">
      <iframe src="https://www.google.com/maps?q=<?php echo urlencode($site_map_query); ?>&output=embed" loading="lazy" title="Chhanda Wellbeing Wish Center Location"></iframe>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
