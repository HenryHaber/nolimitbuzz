FROM wordpress:latest

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY ./wordpress_data /var/www/html

# Expose port 80 for web access
EXPOSE 80
