FROM nginx:1.13.12-alpine

# Release version
ENV DASHBOARD_RELEASE_VERSION=1.1.0

# Install services
RUN apk add --update \
    nodejs=8.9.3-r1

# Set working directory and copy source
WORKDIR /var/www
COPY . /var/www

# Install node modules
RUN npm i

# Build frontend assets
RUN npm run build

# Expose application port
EXPOSE 3080
