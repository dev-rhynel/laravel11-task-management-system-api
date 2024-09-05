#[Dockerfile]
#
# Build a Docker image for the Laravel application.
#
# @param string $composerAuth The Composer authentication token.
# @param string $dbConnection The database connection.
# @param string $dbHost The database host.
# @param string $dbPort The database port.
# @param string $dbDatabase The database name.
# @param string $dbUsername The database username.
# @param string $dbPassword The database password.
# @return void
#
FROM php:8.2.11-fpm@sha256:202df6c6d8e4ecb716e5e6b2836ba91993705b3c7e97eba2c0f905d96b77cdc8 AS base

# Set the working directory inside the Docker container
RUN mkdir -p /app

# Copy the entire project directory to the Docker container
COPY . /app

# Install Composer
RUN cd /app && \
    echo "Install COMPOSER" && \
    # Download the Composer installer script
    curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    # Install Composer globally inside the Docker container
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    # Remove the installer script
    rm composer-setup.php

# Install important libraries
RUN apt-get update && \
    apt-get -y install --fix-missing \
    apt-utils \
    build-essential \
    git \
    libcurl4 \
    libcurl4-openssl-dev \
    zlib1g-dev \
    libzip-dev \
    zip \
    libbz2-dev \
    locales \
    libmcrypt-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    nginx

# Install PHP extensions using docker-php-extension-installer
# This script is used to install various PHP extensions such as GD and Xdebug.
# The script is downloaded from the latest release of the docker-php-extension-installer repository.
# The script is then executed with the arguments 'gd' and 'xdebug' to install the GD and Xdebug extensions.
# The script is wrapped in a subshell to prevent the command from modifying the host environment.
# If the script cannot be downloaded, the command returns 1 without throwing an error.
# This is useful for CI/CD pipelines where the script may not be able to download the latest version.
RUN echo "Install PHP extensions" && \
  ( \
    # Download the docker-php-extension-installer script
    curl -sSLf https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - || \
    echo 'return 1' \
  ) | sh -s \
  # Install the GD and Xdebug extensions
  gd xdebug pdo_pgsql pgsql

# Copy the nginx.conf file to the correct location inside the Docker container.
# This file configures Nginx and is used to configure the server block.
COPY ./docker/http.conf /etc/nginx/site-opts.d

# Copy the PHP configuration file to the correct location inside the Docker container.
# This file configures PHP and is used to configure the PHP-FPM pool.
COPY ./docker/php.ini /etc/php/current_version/fpm

# Copy the PHP-FPM configuration file to the correct location inside the Docker container.
# This file configures PHP-FPM and is used to configure the PHP-FPM service.
COPY ./docker/php-fpm.conf /etc/php/current_version/fpm

# Copy the Nginx main configuration file to the correct location inside the Docker container.
# This file configures Nginx and is used to configure the Nginx service.
COPY ./docker/nginx.conf /etc/nginx/nginx.conf

# Create the directory for Nginx to store its runtime files
RUN mkdir -p /run/nginx

# Set the correct permissions for the storage and bootstrap/cache directories inside the Docker container
RUN chown -R www-data: /app/storage/
RUN chown -R www-data: /app/bootstrap/cache/

# Create the laravel.log file and set the correct permissions inside the Docker container
RUN touch /app/storage/logs/laravel.log && \
    chown -R www-data:www-data /app/storage/logs/laravel.log

# Clean up the package lists and remove the cached archives
# This cleans up the apt package manager cache and removes the downloaded
# package lists to free up space in the Docker image.
RUN apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Run Composer to install dependencies and optimize the autoloader.
#
# This line runs the Composer command inside the Docker container.
# It uses the following options:
#
# --prefer-dist: Prefer installing from dist archives instead of VCS repositories.
# --no-progress: Do not output download progress during the installation process.
# --no-interaction: Do not ask for any interactive prompts during the installation process.
# --no-scripts: Do not run the scripts defined in composer.json after the installation process.
# --optimize-autoloader: Optimize the autoloader for better performance.
#
# The 'cd /app' command changes the current working directory inside the Docker container to the /app directory.
# This is where the application code is located.
#
# The '/usr/local/bin/composer install ...' command runs the Composer installation process.
# It installs the dependencies defined in the composer.json file located in the /app directory.
#
# After the dependencies are installed, the 'php artisan config:cache' command is run to cache the application configuration.
# This improves the performance of the application by reducing the number of file system reads required to load the configuration.
RUN \
    cd /app && \
    /usr/local/bin/composer install --prefer-dist --no-progress --no-interaction --no-scripts --optimize-autoloader

# Define the entry point
CMD sh /app/docker/startup.sh
