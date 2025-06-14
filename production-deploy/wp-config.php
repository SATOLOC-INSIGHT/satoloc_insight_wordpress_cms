<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You have already created these ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u675970446_satoloc_wp_cms' );

/** Database username */
define( 'DB_USER', 'u675970446_satoloc_cms_us' );

/** Database password */
define( 'DB_PASSWORD', 'biqTu4-rahrob-vomjec' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '/gRn3cdC_3Ntf^ZG)i2RAoypgS6L,yX+.Q-c%+/fsm=O2VlX]-9Mvee{6cbf2`7,');
define('SECURE_AUTH_KEY',  '8k<e3b.G+m&2>9HL0N$b|u[ZE8M<M-TUy5|Vk]8!7wkv/1f(^NDN8P-.gkF+l|}P');
define('LOGGED_IN_KEY',    'Bs}TK`BJ#bUrwB@@ssB7G,4gK .>zygDl4M=-TPr$3Cho|~QVa2wc := d/;|@J1');
define('NONCE_KEY',        '|jZ1,K:}p;o|fxQdN~Qbw,9NDe[L0h:dTU9L{eoctk>I*sm-fKd.[aC;A*aFJ.vy');
define('AUTH_SALT',        'r;DAb_8b3%&uZM C2Wd3cw;G~j--aIEZ}O]6Fa2WHw1R+/r1uHh&-$g4(52WaV]g');
define('SECURE_AUTH_SALT', '@5<uk&48IfK?|q q}yY|VFON~i1SG[pfJnU<+_J=Ac m|3-|!tp;]z-N[ErBN,j$');
define('LOGGED_IN_SALT',   ',^mL0?2~}1J*bNHM.3-Q4^y:L||T40P/-}:JN|iB64[ZZ{rIl(;[ s#6&22+LKXL');
define('NONCE_SALT',       '06LXoD.0!s-9Vu-e~ngn{*Q`%<R4Q|=$Iva>, <lK+6KTPO|jWRSiLo o]tnD<Ua');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/**
 * Headless CMS Configuration
 * These settings optimize WordPress for headless use with Next.js
 */

// Enable WordPress REST API
define( 'REST_REQUEST_PARAMETER', 'rest_route' );

// CORS Configuration for Next.js frontend
define( 'REST_ENABLE_CORS', true );

// Disable XML-RPC to improve security
define( 'XMLRPC_ENABLED', false );

// Limit post revisions to improve performance
define( 'WP_POST_REVISIONS', 3 );

// Enable automatic updates for security
define( 'WP_AUTO_UPDATE_CORE', true );

// Increase memory limit
define( 'WP_MEMORY_LIMIT', '256M' );

// Security enhancements
define( 'DISALLOW_FILE_EDIT', true );
define( 'FORCE_SSL_ADMIN', true );

/**
 * Custom settings for SatoLOC Insight
 */
// Site URL configuration
define( 'WP_HOME', 'https://cms.satolocinsight.com' );
define( 'WP_SITEURL', 'https://cms.satolocinsight.com' );

// Frontend domain for CORS
define( 'FRONTEND_DOMAIN', 'https://satolocinsight.com' );

/* Add any custom code below this line. */

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php'; 