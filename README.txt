CHANDA WELLBEING WISH CENTER — WEBSITE PACKAGE
================================================

HOW TO RUN
1. This is a PHP website. You need a PHP server (XAMPP/WAMP/LAMP, or any
   shared hosting that supports PHP 7.4+).
2. Copy the whole "chanda-site" folder into your server's web root
   (e.g. htdocs/ for XAMPP, or public_html/ for shared hosting).
3. Open it in a browser, e.g. http://localhost/chanda-site/home.php

PAGES INCLUDED (header menu order)
1. home.php              Home page (3D animated hero, healthcare categories, founder, testimonials)
2. sessions.php           Sessions — Online Yoga Class (Male & Female) and Offline Yoga Class (Female only)
3. products.php           Products page (alternating image/description layout, no prices)
4. gallery.php            Photo/illustration gallery with filters + lightbox (upload your own photos)
5. index.php              Contact Us page — this is also the site's landing/default page
6. about.php              About Us (single yoga coach: Chanda Barat)
7. other-business.php     Other business (currently: Barat Mobile)
- privacy-policy.php     Privacy Policy (footer only)
- terms-conditions.php   Terms & Conditions (footer only)
- blog.php               Wellness blog (footer only)
- includes/header.php    Shared site header & navigation
- includes/footer.php    Shared site footer
- includes/config.php    Edit your business name, phone, email, address, nav order here

PRODUCTS — UPLOADING YOUR OWN PHOTOS
1. Upload each product photo into: assets/images/products/
2. Open products.php and, for each product in the $products array, set
   "img" to your uploaded filename (e.g. "premium-protein.jpg").
3. Leave "img" as "" (empty) for any product and a neat placeholder box
   with an icon will show automatically until you add the real photo.
Current product list: Premium Protein, Energy Up (Booster), Multi-Vitamin,
Calcium, Male Support, Joint Health, Omega 3 — no prices are shown, per your
request; each has a name, description and feature tags only.

BUSINESS DETAILS
- Name: Chhanda Wellbeing Wish Center
- Location: Bankura - Raniganj Rd, near Panjab National Bank, Gangajalghati,
  West Bengal 722133 (matches your Google Business listing)
- All of this lives in includes/config.php — update phone numbers and email
  there once your real ones are ready; they update sitewide automatically.
- The Contact Us page map now embeds your real Gangajalghati location, with
  a "Get Directions" link that opens Google Maps directly.

FLOATING CONTACT BUTTON (bottom-right, every page)
Instead of separate WhatsApp/Facebook icons cluttering the screen, there is
now ONE round button. Tapping/clicking it expands into: Call, WhatsApp,
Directions, Facebook, Instagram, YouTube — tap again (or tap outside) to
close it. Update the links in includes/config.php ($site_facebook,
$site_instagram, $site_youtube, $site_whatsapp, $site_phone).

MOBILE RESPONSIVENESS
Every section — navigation, hero, healthcare grid, sessions cards, founder
section, testimonials, product rows, gallery, contact form, footer, and the
floating contact button — has been checked and adjusted to stack/resize
cleanly on phones and tablets.

DPDP ACT, 2023 (INDIA) COMPLIANCE — WHAT'S BUILT IN
- Privacy Policy (privacy-policy.php) rewritten around the DPDP Act's actual
  structure: key terms, lawful basis/notice, consent withdrawal, data
  sharing, retention & erasure, security, cookies, Data Principal rights
  (access/correction/erasure/grievance/nomination), children's data
  (verifiable parental consent), and a named Grievance Officer.
- IMPORTANT: open includes/config.php and fill in the real
  $grievance_officer_name / $grievance_officer_email / $grievance_officer_phone
  — the DPDP Act requires you to publish a real, reachable contact for
  grievance redressal. Placeholder values are there now.
- Contact Us form now has a REQUIRED consent checkbox (not just a link) —
  this is what makes consent "a clear affirmative action" under the Act.
  Every submission is timestamped with "Consent Given: Yes" in both the
  email and the data/contact-submissions.csv backup file.
- Newsletter signup (footer) now records consenting subscribers into
  data/newsletter-subscribers.csv, with a plain-language purpose notice
  right next to the form.
- A cookie consent banner now appears on first visit (Accept/Decline),
  linking to the Privacy Policy, and remembers the visitor's choice.
- Terms & Conditions references the DPDP Act and links to the Privacy Policy.

Note: this covers the core building blocks (notice, consent, rights,
grievance officer, retention, breach-notification commitment, children's
data). It is not a substitute for legal advice — for a business handling
health-related personal data, it's worth having a lawyer review this before
you rely on it for compliance.

CUSTOMISING
- All business details (name, phone, email, address, WhatsApp number, and
  now Facebook/Instagram/YouTube links) are in includes/config.php — change
  them once and they update sitewide, including the new floating Facebook +
  WhatsApp buttons (bottom-right of every page).
- Products are listed as a PHP array at the top of products.php — add more
  products there and the alternating layout builds automatically. (No prices
  are shown, as requested — just descriptions and an "Enquire" button.)
- Other Business ventures are listed as a PHP array at the top of
  other-business.php — currently just "Barat Mobile". Add a Google Maps link
  later by filling the "map" field for that entry.
- All graphics (mandala, meditating figure, product art) are hand-crafted SVG
  files in assets/images/ — fully editable and license-free for this website.

GALLERY — FULLY AUTOMATIC (no code editing needed)
Just upload your photos directly into: assets/images/gallery/
That's it — the Gallery page automatically detects every photo in that
folder and displays it, in ANY format (JPG, PNG, WEBP, GIF, AVIF, SVG) and
ANY size or resolution. Every photo is automatically cropped/fitted into a
clean, uniform card, so the page always looks tidy no matter what you
upload. To remove a photo, just delete it from the folder. (Optional: for a
custom caption/category instead of the automatic one, edit the small
$gallery_overrides list at the top of gallery.php — not required.)

GETTING YOUR CONTACT FORM ENQUIRIES
Every submission on the Contact Us page is now saved TWO ways:
1. EMAIL — sent to the address set in includes/config.php ($site_email).
   This requires your hosting to have SMTP/mail configured (most Indian
   hosts like Hostinger, GoDaddy, BigRock support this by default once live).
   It will NOT work on your local computer (e.g. XAMPP) without extra setup.
2. CSV FILE (reliable, no setup needed) — every enquiry is also saved into
   data/contact-submissions.csv on your server. Whenever you want to check
   enquiries, log in to your hosting File Manager (or FTP), open the "data"
   folder, download contact-submissions.csv, and open it in Excel or Google
   Sheets. This file is blocked from public browser access for privacy.

ADDING BLOG POSTS (no admin panel — by design, for simplicity & security)
Blog posts live as a PHP array near the top of blog.php. To add a new post:
1. Open blog.php in a text/code editor (via FTP or hosting File Manager).
2. Copy one of the existing entries inside the $posts array and paste it
   as a new line, then change: tag, title, excerpt, date, author and img.
3. Save and re-upload the file — the new post appears on the Blog page
   instantly. No login, database or admin dashboard required.
(If later you'd like a proper admin dashboard to add blog posts/products
from a browser instead of editing files, that would need a database — happy
to build that as a next step if you want it.)

DESIGN
- Colour theme: soft blush pink with rose & gold accents (Indian aesthetic)
- Fonts: Marcellus + Yatra One (display) and Mukta (body) via Google Fonts
- Icons: Font Awesome (via CDN)
- Effects: CSS 3D tilt cards, floating hero animation, scroll-reveal, mandala
  spin animation, gallery lightbox — all in assets/css/style.css and
  assets/js/script.js

Namaste, and best wishes for your wellness center! 🙏
