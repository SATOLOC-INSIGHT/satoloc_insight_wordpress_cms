# Production-Local Sync Guide

## Current Status

- ✅ Production WordPress running at: https://cms.satolocinsight.com
- ✅ Local development environment configured
- ✅ Git repository initialized

## Step 1: Download Production Customizations

You need to download these files from production to ensure they're in sync:

### Files to Download from Hostinger:

1. **wp-config.php** - May have been modified during WordPress setup
2. **wp-content/themes/** - Any custom themes
3. **wp-content/plugins/** - Any installed plugins
4. **wp-content/uploads/** - Uploaded media (optional for git)
5. **.htaccess** - Any modifications made in production

### How to Download:

1. Go to Hostinger File Manager
2. Navigate to your `cms` subdomain folder
3. Download the above files/folders
4. Replace your local versions

## Step 2: Clean Local Repository

### Remove WordPress Core from Git (Recommended):

```bash
# Remove WordPress core files from git tracking
git rm --cached wp-admin/ wp-includes/ wp-*.php index.php license.txt readme.html xmlrpc.php

# Keep only:
# - wp-config.php
# - .htaccess
# - wp-content/ (themes, plugins)
# - Project files (docker-compose, scripts, etc.)
```

### Alternative: Keep WordPress Core in Git:

If you prefer to track WordPress core files, keep them but ensure they're identical between local and production.

## Step 3: Git Workflow Setup

### Initial Commit of Current State:

```bash
git add .
git commit -m "Initial production sync - WordPress CMS setup"
git push origin main
```

### Daily Workflow:

```bash
# Pull latest changes
git pull origin main

# Make changes locally
# Test with Docker: docker-compose -f docker-compose.wordpress.yml up

# Commit changes
git add .
git commit -m "Feature: description of changes"
git push origin main

# Deploy to production (manual or automated)
```

## Step 4: Deployment Options

### Option A: Manual Deployment

1. Download changed files from git
2. Upload to Hostinger via File Manager
3. Test production site

### Option B: Automated Deployment (Advanced)

- Set up GitHub Actions
- Use Hostinger's Git integration (if available)
- Use FTP deployment scripts

## Step 5: File Synchronization Strategy

### What to Track in Git:

- ✅ wp-config.php (production version)
- ✅ .htaccess
- ✅ wp-content/themes/ (custom themes)
- ✅ wp-content/plugins/ (custom plugins)
- ✅ Project files (docker-compose, scripts, docs)

### What NOT to Track:

- ❌ wp-content/uploads/ (media files)
- ❌ wp-content/cache/
- ❌ WordPress core files (optional)
- ❌ wordpress-data/ (Docker volume)

## Step 6: Environment-Specific Files

### Local Development (wp-config-local.php):

```php
// Local database settings
define('DB_HOST', 'wordpress_db:3306');
define('DB_NAME', 'satoloc_wordpress');
// ... local settings
```

### Production (wp-config.php):

```php
// Production database settings
define('DB_HOST', 'localhost');
define('DB_NAME', 'u675970446_satoloc_wp_cms');
// ... production settings
```

## Next Steps

1. **Download production files** - Get current state from Hostinger
2. **Clean git repository** - Remove/organize files per .gitignore
3. **Commit current state** - Create baseline in git
4. **Set up deployment workflow** - Choose manual or automated
5. **Test the flow** - Make a test change and deploy
