# WordPress CMS Production Deployment Guide

## SatoLOC Insight - Hostinger Deployment

### Current Status ✅

- [x] Subdomain created: `cms.satolocinsight.com`
- [x] MySQL database created: `u675970446_satoloc_wp_cms`
- [x] Database user created: `u675970446_satoloc_cms_us`
- [x] Production files prepared

### Next Steps

## Step 4: Download WordPress Core Files

1. **Download latest WordPress:**
   - Go to https://wordpress.org/download/
   - Download the latest WordPress ZIP file
   - Extract it to your computer

## Step 5: Prepare Files for Upload

### Files to Customize:

1. **wp-config.php** (use the one we created):

   - Replace `YOUR_DATABASE_PASSWORD_HERE` with your actual database password
   - Generate new security keys at: https://api.wordpress.org/secret-key/1.1/salt/
   - Replace all the "put your unique phrase here" with the generated keys

2. **.htaccess** (use the one we created):
   - Upload this file to enable proper URL rewriting and CORS

### File Structure to Upload:

```
cms.satolocinsight.com/
├── wp-config.php          (our customized version)
├── .htaccess             (our customized version)
├── index.php             (from WordPress download)
├── wp-admin/             (from WordPress download)
├── wp-content/           (from WordPress download)
├── wp-includes/          (from WordPress download)
└── ... (all other WordPress core files)
```

## Step 6: Upload Files to Hostinger

### Method 1: File Manager (Recommended)

1. Go to Hostinger control panel
2. Navigate to **Files** → **File Manager**
3. Go to `public_html/cms` directory (your subdomain folder)
4. Upload all WordPress files
5. Upload our custom `wp-config.php` and `.htaccess` files

### Method 2: FTP/SFTP

1. Use FTP client (FileZilla, WinSCP, etc.)
2. Connect to your Hostinger server
3. Navigate to subdomain directory
4. Upload all files

## Step 7: WordPress Installation

1. **Visit your subdomain**: https://cms.satolocinsight.com
2. **Complete WordPress setup**:
   - Site Title: `SatoLOC Insight CMS`
   - Username: Choose admin username
   - Password: Use a strong password
   - Email: Your email address
3. **Log in to WordPress admin**: https://cms.satolocinsight.com/wp-admin

## Step 8: Configure WordPress for Headless CMS

### Install Required Plugins:

1. **WP REST API Controller** (if needed)
2. **Custom Post Type UI** (for custom content types)
3. **Advanced Custom Fields** (for custom fields)
4. **Yoast SEO** (for SEO management)

### WordPress Settings to Configure:

1. **Settings** → **General**:
   - Site Address: `https://cms.satolocinsight.com`
2. **Settings** → **Permalinks**:
   - Choose "Post name" structure
3. **Settings** → **Reading**:
   - Uncheck "Search engine visibility" (make site public)

## Step 9: Test REST API

After installation, test these endpoints:

- `https://cms.satolocinsight.com/wp-json/wp/v2/posts`
- `https://cms.satolocinsight.com/wp-json/wp/v2/pages`
- `https://cms.satolocinsight.com/wp-json/wp/v2/categories`

## Step 10: SSL Certificate

1. In Hostinger control panel, navigate to **SSL**
2. Enable SSL for `cms.satolocinsight.com`
3. Force HTTPS redirect

## Security Checklist ✅

- [ ] Strong admin password
- [ ] Latest WordPress version
- [ ] Security plugins installed
- [ ] File permissions set correctly
- [ ] Regular backups configured
- [ ] XML-RPC disabled
- [ ] Directory browsing disabled

## Next Phase: Next.js Integration

After WordPress is running:

1. Update Next.js app to use production API endpoints
2. Test API calls from your frontend
3. Configure proper error handling
4. Set up content preview functionality

---

## Database Connection Details (Reference)

- **Host**: localhost
- **Database**: u675970446_satoloc_wp_cms
- **Username**: u675970446_satoloc_cms_us
- **Password**: [Your password]

## Important URLs

- **CMS Admin**: https://cms.satolocinsight.com/wp-admin
- **REST API Base**: https://cms.satolocinsight.com/wp-json/wp/v2/
- **Frontend Site**: https://satolocinsight.com
