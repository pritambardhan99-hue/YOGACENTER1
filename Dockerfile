# Chhanda Wellbeing Wish Center — Dockerfile for Render.com
# Render doesn't run PHP natively, so this packages your site with
# Apache + PHP inside a container that Render can build and run.

FROM php:8.2-apache

# Enable .htaccess support — needed so the "data" folder (which stores
# contact-form/newsletter submissions) stays blocked from public access.
RUN a2enmod rewrite headers \
    && sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# ---- Production PHP hardening ----
# By default PHP shows warnings/errors directly on the page, which can leak
# internal server file paths to visitors (exactly what happened locally on
# XAMPP). In production, errors are logged server-side instead, never shown
# to the public. expose_php is also turned off so response headers don't
# advertise the exact PHP version running (reduces information disclosure
# to anyone probing the site for known vulnerabilities).
RUN { \
      echo 'display_errors = Off'; \
      echo 'display_startup_errors = Off'; \
      echo 'log_errors = On'; \
      echo 'error_reporting = E_ALL'; \
      echo 'expose_php = Off'; \
      echo 'session.cookie_httponly = 1'; \
      echo 'session.cookie_samesite = Lax'; \
      echo 'upload_max_filesize = 8M'; \
      echo 'post_max_size = 8M'; \
    } > /usr/local/etc/php/conf.d/production-hardening.ini

# Hide the Apache/PHP version string from response headers too (another
# small piece of information a would-be attacker could otherwise use).
RUN { \
      echo 'ServerTokens Prod'; \
      echo 'ServerSignature Off'; \
    } >> /etc/apache2/apache2.conf

# Copy the entire website into Apache's web root
COPY . /var/www/html/

# ---- Defense in depth: block the "data" folder at the Apache server-config
# level too, not just via .htaccess. This means the CSV backups (contact
# form / newsletter submissions) stay private even if .htaccess support
# were ever misconfigured or disabled. ----
RUN { \
      echo '<Directory "/var/www/html/data">'; \
      echo '    Require all denied'; \
      echo '</Directory>'; \
    } > /etc/apache2/conf-available/block-data-folder.conf \
    && a2enconf block-data-folder

# Make sure the "data" folder is writable by the web server, so the
# contact form and newsletter signup can save their CSV records
RUN mkdir -p /var/www/html/data \
    && chown -R www-data:www-data /var/www/html/data \
    && chmod -R 775 /var/www/html/data

# Render assigns a port at runtime via the $PORT environment variable.
# Default to 8080 for local testing; Apache will pick up Render's actual
# value automatically at container startup. (Targeted replacements only —
# not a blanket find/replace of "80" — so nothing else in these files can
# accidentally get corrupted.)
ENV PORT=8080
RUN sed -i 's/Listen 80/Listen ${PORT}/' /etc/apache2/ports.conf \
    && sed -i 's/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/' /etc/apache2/sites-available/000-default.conf

EXPOSE 8080

CMD ["apache2-foreground"]
