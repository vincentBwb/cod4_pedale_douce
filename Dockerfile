# Choose the image
FROM atsanna/codeigniter4:latest

# Config. current working directory
WORKDIR /var/www/html

# Change project folder name (Rewrite 000-default.conf file)
COPY ./000-default.conf /etc/apache2/sites-available

# Install GD module and libraries
RUN apt-get update
RUN apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/freetype2 --with-png-dir=/usr/include --with-jpeg-dir=/usr/include
RUN docker-php-ext-install gd

# Config. exposed port
EXPOSE 80
