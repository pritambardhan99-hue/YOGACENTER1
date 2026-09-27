document.addEventListener('DOMContentLoaded', function () {

  /* Mobile nav toggle — simple dropdown below header (no overlay/backdrop) */
  var hamburger = document.querySelector('.hamburger');
  var nav       = document.querySelector('.main-nav');

  function openMobileNav() {
    if (!nav) return;
    nav.classList.add('open');
    if (hamburger) { hamburger.classList.add('open'); hamburger.setAttribute('aria-expanded', 'true'); }
  }
  function closeMobileNav() {
    if (!nav) return;
    nav.classList.remove('open');
    if (hamburger) { hamburger.classList.remove('open'); hamburger.setAttribute('aria-expanded', 'false'); }
  }

  if (hamburger && nav) {
    hamburger.addEventListener('click', function () {
      if (nav.classList.contains('open')) closeMobileNav(); else openMobileNav();
    });
    nav.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', closeMobileNav);
    });
    // If the window is resized back to desktop width while the menu is
    // open, reset it so it doesn't get stuck open.
    window.addEventListener('resize', function () {
      if (window.innerWidth > 980) closeMobileNav();
    });
  }

  /* Sticky header shrink + back to top visibility */
  var header = document.querySelector('.site-header');
  var backTop = document.querySelector('.back-to-top');
  window.addEventListener('scroll', function () {
    if (backTop) backTop.classList.toggle('show', window.scrollY > 500);
  });
  if (backTop) {
    backTop.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* Scroll reveal (data-aos) via IntersectionObserver */
  var revealEls = document.querySelectorAll('[data-aos]');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var delay = entry.target.getAttribute('data-aos-delay') || 0;
          setTimeout(function () { entry.target.classList.add('aos-in'); }, delay);
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });
    revealEls.forEach(function (el) { io.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('aos-in'); });
  }

  /* 3D tilt effect on cards */
  var tiltEls = document.querySelectorAll('.tilt-card, .p-media .card3d, .gallery-item');
  tiltEls.forEach(function (el) {
    el.addEventListener('mousemove', function (e) {
      var rect = el.getBoundingClientRect();
      var x = e.clientX - rect.left;
      var y = e.clientY - rect.top;
      var rotateX = ((y / rect.height) - 0.5) * -10;
      var rotateY = ((x / rect.width) - 0.5) * 10;
      el.style.transform = 'perspective(900px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg) translateY(-4px)';
    });
    el.addEventListener('mouseleave', function () {
      el.style.transform = '';
    });
  });

  /* Hero mouse parallax */
  var heroArt = document.querySelector('.hero-art');
  if (heroArt) {
    heroArt.addEventListener('mousemove', function (e) {
      var rect = heroArt.getBoundingClientRect();
      var x = ((e.clientX - rect.left) / rect.width - 0.5) * 14;
      var y = ((e.clientY - rect.top) / rect.height - 0.5) * 14;
      var fig = heroArt.querySelector('.hero-figure-wrap');
      if (fig) fig.style.transform = 'rotateY(' + x + 'deg) rotateX(' + (-y) + 'deg)';
    });
    heroArt.addEventListener('mouseleave', function () {
      var fig = heroArt.querySelector('.hero-figure-wrap');
      if (fig) fig.style.transform = '';
    });
  }

  /* Animated counters */
  var counters = document.querySelectorAll('[data-count]');
  var counted = false;
  function animateCounters() {
    if (counted) return;
    var statsSection = document.querySelector('.hero-stats');
    if (!statsSection) return;
    var rect = statsSection.getBoundingClientRect();
    if (rect.top < window.innerHeight - 60) {
      counted = true;
      counters.forEach(function (el) {
        var target = parseInt(el.getAttribute('data-count'), 10);
        var current = 0;
        var step = Math.max(1, Math.ceil(target / 60));
        var timer = setInterval(function () {
          current += step;
          if (current >= target) { current = target; clearInterval(timer); }
          el.textContent = current + (el.getAttribute('data-suffix') || '');
        }, 25);
      });
    }
  }
  window.addEventListener('scroll', animateCounters);
  animateCounters();

  /* Gallery filter */
  var filterBtns = document.querySelectorAll('.gallery-filter button');
  var galleryItems = document.querySelectorAll('.gallery-item');
  filterBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      filterBtns.forEach(function (b) { b.classList.remove('active'); });
      btn.classList.add('active');
      var cat = btn.getAttribute('data-filter');
      galleryItems.forEach(function (item) {
        var show = cat === 'all' || item.getAttribute('data-cat') === cat;
        item.style.display = show ? '' : 'none';
      });
    });
  });

  /* Gallery lightbox */
  var lightbox = document.querySelector('.lightbox');
  if (lightbox) {
    var lbImg = lightbox.querySelector('img');
    document.querySelectorAll('.gallery-item img').forEach(function (img) {
      img.addEventListener('click', function () {
        lbImg.src = img.src;
        lightbox.classList.add('open');
      });
    });
    lightbox.addEventListener('click', function (e) {
      if (e.target === lightbox || e.target.classList.contains('lightbox-close')) {
        lightbox.classList.remove('open');
      }
    });
  }

  /* Simple client-side contact form validation (progressive enhancement) */
  var form = document.querySelector('#contactForm');
  if (form) {
    form.addEventListener('submit', function (e) {
      var required = form.querySelectorAll('[required]');
      var ok = true;
      required.forEach(function (f) {
        if (!f.value.trim()) { ok = false; f.style.borderColor = '#C2185B'; }
        else { f.style.borderColor = ''; }
      });
      if (!ok) { e.preventDefault(); }
    });
  }

  /* Consolidated Social FAB toggle */
  var fab = document.querySelector('.social-fab');
  var fabToggle = document.querySelector('.social-fab-toggle');
  var fabBackdrop = document.querySelector('.fab-backdrop');
  if (fab && fabToggle) {
    function closeFab() {
      fab.classList.remove('open');
      fabToggle.setAttribute('aria-expanded', 'false');
      if (fabBackdrop) fabBackdrop.classList.remove('show');
    }
    function toggleFab() {
      var isOpen = fab.classList.toggle('open');
      fabToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      if (fabBackdrop) fabBackdrop.classList.toggle('show', isOpen);
    }
    fabToggle.addEventListener('click', function (e) {
      e.stopPropagation();
      toggleFab();
    });
    if (fabBackdrop) fabBackdrop.addEventListener('click', closeFab);
    document.addEventListener('click', function (e) {
      if (fab.classList.contains('open') && !fab.contains(e.target)) closeFab();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeFab();
    });
  }

  /* Cookie Consent Banner (DPDP Act, 2023) */
  var cookieBanner = document.getElementById('cookieBanner');
  var cookieAccept  = document.getElementById('cookieAccept');
  var cookieDecline = document.getElementById('cookieDecline');
  if (cookieBanner) {
    var cookieChoice = null;
    try { cookieChoice = localStorage.getItem('chanda_cookie_consent'); } catch (err) {}
    if (!cookieChoice) {
      setTimeout(function () { cookieBanner.classList.add('show'); }, 900);
    }
    function setCookieChoice(value) {
      try { localStorage.setItem('chanda_cookie_consent', value); } catch (err) {}
      cookieBanner.classList.remove('show');
    }
    if (cookieAccept) cookieAccept.addEventListener('click', function () { setCookieChoice('accepted'); });
    if (cookieDecline) cookieDecline.addEventListener('click', function () { setCookieChoice('declined'); });
  }

});
