HOW TO DEPLOY THIS SITE ON RENDER.COM
========================================

Render doesn't run PHP natively — the Dockerfile in this folder packages
your site with PHP + Apache inside a small container that Render can build
and run. You don't need to understand Docker to use this; just follow the
steps below.

────────────────────────────────────────
STEP 1 — Put this folder on GitHub
────────────────────────────────────────
Render deploys from a GitHub repository, so this folder needs to live there
first.

1. Create a free account at https://github.com if you don't have one.
2. Create a new EMPTY repository (e.g. named "chanda-website"). Do NOT
   initialise it with a README — keep it empty.
3. On your computer, open a terminal/command prompt inside this "chanda"
   folder (the one containing Dockerfile, index.php, etc.) and run:

     git init
     git add .
     git commit -m "Initial site upload"
     git branch -M main
     git remote add origin https://github.com/YOUR-USERNAME/chanda-website.git
     git push -u origin main

   (Replace YOUR-USERNAME/chanda-website with your actual GitHub username
   and repo name. GitHub will show you these exact commands on the empty
   repo's page too.)

   No terminal experience? You can also drag-and-drop all these files
   directly into the GitHub repo through your browser using the "Add file
   → Upload files" button on the repository page — no commands needed.

────────────────────────────────────────
STEP 2 — Connect the repo to Render
────────────────────────────────────────
1. Go to https://render.com and sign up / log in (you can sign up directly
   with your GitHub account, which makes this step easier).
2. Click "New +" → "Web Service".
3. Select your "chanda-website" GitHub repo.
4. Render should automatically detect the Dockerfile and the render.yaml
   config in this folder. Confirm:
     - Runtime: Docker
     - Plan: Free
5. Click "Create Web Service".
6. Wait 2–5 minutes while Render builds and starts the container.
7. You'll get a live URL like: https://chanda-wellbeing-wish-center.onrender.com

That's it — your site is live at that address.

────────────────────────────────────────
IMPORTANT LIMITATIONS OF RENDER'S FREE TIER
────────────────────────────────────────
Please read this before relying on the live site for real enquiries:

1. THE SITE SLEEPS WHEN IDLE
   Free services spin down after 15 minutes of no visitors, and take
   ~30–50 seconds to wake back up on the next visit. Fine for showing
   someone a preview link; not ideal for a live business site customers
   rely on.

2. CONTACT FORM SUBMISSIONS WILL NOT BE SAVED RELIABLY
   Your contact form normally saves enquiries to data/contact-submissions.csv
   as a backup, and also tries to email you. On Render's free tier:
     - The container's storage is TEMPORARY — any CSV file written while
       the site is running gets WIPED whenever the service restarts,
       sleeps, or redeploys. You cannot rely on it for real leads.
     - PHP's mail() function will NOT work at all in this container,
       because there is no mail server configured inside it. Emails will
       silently fail to send (this won't break the site, but no email
       will arrive).
   In short: on Render's free tier, enquiries submitted through your
   contact form may be LOST. This setup is best used as a visual/demo
   preview link, not as your real, live business website.

3. NO CUSTOM DOMAIN ON THE FREE PLAN'S DEFAULT SETUP
   You'll get a *.onrender.com address; connecting your own domain name
   is possible but is a separate step you'd configure in Render's
   dashboard.

────────────────────────────────────────
FOR YOUR ACTUAL LIVE BUSINESS SITE
────────────────────────────────────────
Once you're ready to go live for real (accepting genuine customer
enquiries), a regular PHP hosting plan — like Hostinger, GoDaddy, or
similar Indian hosts (roughly ₹99–199/month) — will serve this exact same
code correctly, with working email, permanent file storage, and no
sleep/wake delay. You would simply upload these same files (minus the
Dockerfile/render.yaml, which aren't needed there) via File Manager or FTP,
exactly as you've been testing locally with XAMPP.

────────────────────────────────────────
SECURITY HARDENING APPLIED (before going live)
────────────────────────────────────────
A full security pass was done before this deployment. Fixed:

1. PHP errors no longer display on the page (were leaking server file
   paths, e.g. "C:\xampp\htdocs\chanda\products.php" — now logged
   server-side only, invisible to visitors).
2. PHP version and Apache version no longer disclosed in HTTP headers.
3. The "data" folder (contact/newsletter CSV backups) is now blocked by
   TWO independent layers — Apache server config AND .htaccess — so it
   stays private even if one layer is ever misconfigured.
4. Deployment files (Dockerfile, render.yaml, READMEs) are excluded from
   the container image entirely via .dockerignore, so they can never be
   downloaded by visiting their URL directly.
5. Security response headers added (X-Content-Type-Options, X-Frame-Options,
   Referrer-Policy, Permissions-Policy) and directory listing disabled.
6. Contact form and newsletter form hardened against:
   - Email header injection (a malicious multi-line "name" field could
     previously have let someone inject extra email headers)
   - CSV formula injection (a name/message starting with =, +, - or @
     could have executed as a spreadsheet formula when you open the CSV
     backups in Excel)
   - Basic spam bots (invisible honeypot field — bots fill it in, humans
     never see it, so bot submissions are silently dropped)
7. Fixed a real bug: the contact form was emailing enquiries to an old
   placeholder address instead of your real email, because the site
   settings hadn't loaded yet at that point in the code. Now fixed —
   confirm your real email in includes/config.php ($site_email) is
   correct before relying on it.

NOT INCLUDED (optional, only worth adding if this grows into a bigger
public-facing site):
- A real CAPTCHA (e.g. Google reCAPTCHA) for the contact form — the
  honeypot handles casual bots; a CAPTCHA would help against more
  determined spam but requires a free Google API key to set up.
- Rate limiting on form submissions — would need a database or Redis to
  track submission counts per IP; not set up here since this is a
  single-container free-tier deployment.
- A Content-Security-Policy header — deliberately left out because it's
  easy to misconfigure and accidentally break the Google Fonts/Font
  Awesome CDN resources this site uses; the other headers above already
  cover the most common attack classes.
