FROM php:7.2.14-apache-stretch

#The below line is a simple way to force docker to not use cached images...  Just increment it...
#Sometimes apt-get urls are changed and so you need to run an update but it won't since it's cached...
RUN echo Image No Cache Version 1

RUN apt-get update -y
RUN apt-get install -y wget

# Enabled apache modules
RUN a2enmod rewrite
RUN a2enmod vhost_alias

#Set datetime to UTC
RUN echo date.timezone=UTC >> /usr/local/etc/php/conf.d/datetime.ini

# Install XDEBUG
RUN yes | pecl install xdebug-2.6.1

# Configure XDEBUG
RUN echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.profiler_output_dir=\"/var/www/html/public/ac.nlocal.info/profilings\"" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.profiler_enable_trigger=1" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.profiler_enable=0" >> /usr/local/etc/php/conf.d/xdebug.ini

# Install phpunit
RUN wget https://phar.phpunit.de/phpunit-3.7.38.phar -O phpunit.phar \
    && chmod +x phpunit.phar \
    && mv phpunit.phar /usr/local/bin/phpunit

# Increase Max Upload Size
RUN echo "post_max_size=32M" > /usr/local/etc/php/conf.d/upload_settings.ini \
    && echo "upload_max_filesize=32M" >> /usr/local/etc/php/conf.d/upload_settings.ini \
    && echo "upload_tmp_dir=/tmp" >> /usr/local/etc/php/conf.d/upload_settings.ini

# Enable Error Logging
RUN touch /var/log/php_errors
RUN chmod a+rwx /var/log/php_errors
RUN echo "log_errors=On" > /usr/local/etc/php/conf.d/logging.ini \
    && echo "error_log=/var/log/php_errors" >> /usr/local/etc/php/conf.d/logging.ini \
    && echo "upload_tmp_dir=/tmp" >> /usr/local/etc/php/conf.d/logging.ini

# Allow .htaccess
RUN echo "<Directory /var/www/html/public/>" >> /etc/apache2/conf-enabled/vhost_alias.conf \
 && echo "  AllowOverride all" >> /etc/apache2/conf-enabled/vhost_alias.conf \
 && echo "</Directory>" >> /etc/apache2/conf-enabled/vhost_alias.conf

# Enable debug logging
RUN echo "LogLevel debug" >> /etc/apache2/conf-enabled/debug_logging

RUN echo "VirtualDocumentRoot /var/www/html/public/%0" >> /etc/apache2/conf-enabled/vhost_alias.conf