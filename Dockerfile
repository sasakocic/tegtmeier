FROM php:8.3-cli

WORKDIR /app

# Install dependencies for composer and git operations
RUN apt-get update && apt-get install -y \
    libxml2-dev \
    zlib1g-dev \
    libpq-dev \
    unzip \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Copy project files first to leverage Docker cache
COPY composer.json composer.lock ./

# Install composer and dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --prefer-dist

# Enable Xdebug for code coverage via PECL
RUN pecl install xdebug-3.4.0 && docker-php-ext-enable xdebug

# Set environment variable for coverage mode
ENV XDEBUG_MODE=coverage

# Run tests with coverage and analysis
CMD ["bash", "-c", "composer run analysis && composer run check && composer run mess-detector && composer run php-depend && vendor/bin/phpunit --testdox --colors --no-interaction --log-junit ./build/logs/junit.xml tests"]
