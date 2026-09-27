<?php
/**
 * Chhanda Wellbeing Wish Center — Global Site Configuration
 * Edit business details here; they are reused across every page.
 */

$site_name        = "Chhanda Wellbeing Wish Center";
$site_tagline     = "योग • ध्यान • आयुर्वेद";
$site_short       = "Chhanda Wellbeing";
$site_email       = "mumpybarat1@gmail.com";
$site_email_care  = "mumpybarat1@gmail.com";
$site_phone       = "+91 70019 14862";
$site_phone2      = ""; // no second number — kept blank so old markup referencing it stays harmless
$site_address     = "Bankura - Raniganj Rd, near Panjab National Bank, Gangajalghati, West Bengal 722133";
$site_city        = "Gangajalghati, West Bengal";
$site_map_query   = "Chhanda Wellbeing Wish Center, Bankura - Raniganj Rd, near Panjab National Bank, Gangajalghati, West Bengal 722133";
$site_map_link    = "https://www.google.com/maps/search/?api=1&query=" . urlencode($site_map_query);
$site_hours       = "Mon – Sat: 6:00 AM – 8:00 PM &nbsp;|&nbsp; Sun: 7:00 AM – 12:00 PM";

// ---- DPDP Act, 2023 (India) — Grievance Officer details ----
// Required to be published under the Digital Personal Data Protection Act.
// Replace with your actual designated person before going live.
$grievance_officer_name  = "Chanda Barat";
$grievance_officer_email = "grievance@chandawellbeing.in";
$grievance_officer_phone = $site_phone;
$grievance_response_days = "30 days";

// Default flags used by shared includes (pages can override before including header.php)
$newsletter_success = false;
$site_whatsapp    = "919876543210";
$site_facebook    = "#"; // paste your Facebook Page URL here
$site_instagram   = "#"; // paste your Instagram profile URL here
$site_youtube     = "#"; // paste your YouTube channel URL here
$current_year     = date("Y");

// Bump this number whenever you update CSS/JS files, so visitors' browsers
// always load the newest version instead of a stale cached copy.
$asset_version    = "5.0";

// Base path so includes work no matter which folder depth calls them
$base_url = "/";

// Main navigation (label => file) — order controls the header menu order
$nav_links = [
    "Home"            => "home.php",
    "Sessions"        => "sessions.php",
    "Products"        => "products.php",
    "Gallery"         => "gallery.php",
    "Contact Us"      => "index.php",
    "About Us"        => "about.php",
    "Other Business"  => "other-business.php",
];

// Helper: mark active nav link
function is_active($file) {
    $current = basename($_SERVER['PHP_SELF']);
    if ($file === 'index.php' && ($current === 'index.php' || $current === '')) return true;
    return $current === $file;
}
?>
