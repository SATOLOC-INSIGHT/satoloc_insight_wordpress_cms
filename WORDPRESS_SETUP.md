# SatoLOC WordPress CMS Setup Guide

This guide will help you set up and manage the headless WordPress CMS for SatoLOC Insight.

## Overview

We use WordPress as a headless CMS to manage blog content, which is then consumed by our Next.js frontend via the WordPress REST API. This setup provides:

- Easy content management for non-technical users
- SEO-friendly blog posts
- Flexible content structure
- Separation of content management and presentation

## Prerequisites

- Docker and Docker Compose installed
- Basic knowledge of WordPress admin

## Quick Start

### 1. Start WordPress Environment

```bash
# Start WordPress, MySQL, and phpMyAdmin
./scripts/wordpress-setup.sh start
```

### 2. Access WordPress Admin

After starting the environment (wait 30-60 seconds for all services to be ready):

- **WordPress Admin**: http://localhost:8080/wp-admin
- **WordPress Site**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081 (for database management)

### 3. Initial WordPress Setup

1. Visit http://localhost:8080 to start the WordPress installation
2. Select your language
3. Create admin account:
   - Site Title: `SatoLOC Insight Blog`
   - Username: `admin` (or your preferred username)
   - Password: Use a strong password
   - Email: Your email address
4. Click "Install WordPress"

## Environment Management

### Available Commands

```bash
# Start the WordPress environment
./scripts/wordpress-setup.sh start

# Stop the WordPress environment
./scripts/wordpress-setup.sh stop

# Restart the WordPress environment
./scripts/wordpress-setup.sh restart

# Reset WordPress (removes all data - use with caution!)
./scripts/wordpress-setup.sh reset

# View WordPress container logs
./scripts/wordpress-setup.sh logs

# Check container status
./scripts/wordpress-setup.sh status

# Show help
./scripts/wordpress-setup.sh help
```

## WordPress Configuration

### Database Connection Details

- **Host**: localhost:3307 (from outside Docker)
- **Database**: satoloc_wordpress
- **Username**: satoloc_wp_user
- **Password**: satoloc_wp_password

### REST API Configuration

The WordPress REST API is automatically enabled with the following features:

- **Base URL**: http://localhost:8080/wp-json/wp/v2/
- **Posts Endpoint**: http://localhost:8080/wp-json/wp/v2/posts
- **Pages Endpoint**: http://localhost:8080/wp-json/wp/v2/pages
- **Categories**: http://localhost:8080/wp-json/wp/v2/categories
- **Tags**: http://localhost:8080/wp-json/wp/v2/tags

## Directory Structure

```
satoloc-insight-frontend-v1/
├── docker-compose.wordpress.yml    # WordPress Docker configuration
├── scripts/
│   └── wordpress-setup.sh          # Management script
├── wordpress-data/                 # WordPress files (auto-created)
├── wordpress-plugin/
│   └── satoloc-connector/          # Custom WordPress plugin
└── docs/
    └── WORDPRESS_SETUP.md          # This guide
```

## Custom Plugin

The `satoloc-connector` plugin provides:

- Custom REST API endpoints
- SEO enhancements
- Integration with SatoLOC Insight features

The plugin is automatically mounted in the WordPress container.

## Troubleshooting

### Container Won't Start

1. Check if Docker is running:

   ```bash
   docker info
   ```

2. Check for port conflicts:

   ```bash
   lsof -i :8080
   lsof -i :8081
   lsof -i :3307
   ```

3. View container logs:
   ```bash
   ./scripts/wordpress-setup.sh logs
   ```

### Reset Environment

If you encounter persistent issues:

```bash
./scripts/wordpress-setup.sh reset
./scripts/wordpress-setup.sh start
```

### Database Access

Use phpMyAdmin at http://localhost:8081:

- **Server**: wordpress_db
- **Username**: root
- **Password**: satoloc_root_password

## Production Deployment

For production deployment, you'll need to:

1. Set up a managed WordPress hosting service (e.g., WordPress.com, WP Engine)
2. Or deploy WordPress on a cloud server (AWS, DigitalOcean, etc.)
3. Update the REST API endpoints in your Next.js app
4. Configure proper SSL certificates
5. Set up proper backup strategies

## Next Steps

1. Complete WordPress setup
2. Activate and configure the satoloc-connector plugin
3. Create sample blog posts
4. Configure WordPress REST API integration in Next.js
5. Set up blog listing and detail pages

## Security Notes

- Change default passwords in production
- Use strong authentication
- Keep WordPress and plugins updated
- Implement proper backup strategies
- Use SSL in production
