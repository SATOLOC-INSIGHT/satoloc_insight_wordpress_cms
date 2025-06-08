<?php
/**
 * WordPress Configuration for Hostinger Git Deployment
 * This file will be used when deploying via Hostinger's Git integration
 */

// ** Database settings - Production ** //
define( 'DB_NAME', 'u675970446_satoloc_wp_cms' );
define( 'DB_USER', 'u675970446_satoloc_cms_us' );
define( 'DB_PASSWORD', 'biqTu4-rahrob-vomjec' );
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 */
define('AUTH_KEY',         '/gRn3cdC_3Ntf^ZG)i2RAoypgS6L,yX+.Q-c%+/fsm=O2VlX]-9Mvee{6cbf2`7,');
define('SECURE_AUTH_KEY',  '8k<e3b.G+m&2>9HL0N$b|u[ZE8M<M-TUy5|Vk]8!7wkv/1f(^NDN8P-.gkF+l|}P');
define('LOGGED_IN_KEY',    'Bs}TK`BJ#bUrwB@@ssB7G,4gK .>zygDl4M=-TPr$3Cho|~QVa2wc := d/;|@J1');
define('NONCE_KEY',        '|jZ1,K:}p;o|fxQdN~Qbw,4gK[L0h:dTU9L{eoctk>I*sm-fKd.[aC;A*aFJ.vy');
define('AUTH_SALT',        'r;DAb_8b3%&uZM C2Wd3cw;G~j--aIEZ}O]6Fa2WHw1R+/r1uHh&-$g4(52WaV]g');
define('SECURE_AUTH_SALT', '@5<uk&48IfK?|q q}yY|VFON~i1SG[pfJnU<+_J=Ac m|3-|!tp;]z-N[ErBN,j$');
define('LOGGED_IN_SALT',   ',^mL0?2~}1J*bNHM.3-Q4^y:L||T40P/-}:JN|iB64[ZZ{rIl(;[ s#6&22+LKXL');
define('NONCE_SALT',       '06LXoD.0!s-9Vu-e~ngn{*Q`%<R4Q|=$Iva>, <lK+6KTPO|jWRSiLo o]tnD<Ua');

/**#@-*/

$table_prefix = 'wp_';

define( 'WP_DEBUG', false );

/**
 * Headless CMS Configuration for Production
 */
define( 'REST_REQUEST_PARAMETER', 'rest_route' );
define( 'REST_ENABLE_CORS', true );
define( 'XMLRPC_ENABLED', false );
define( 'WP_POST_REVISIONS', 3 );
define( 'WP_AUTO_UPDATE_CORE', true );
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'DISALLOW_FILE_EDIT', true );
define( 'FORCE_SSL_ADMIN', true );

/**
 * Site URL configuration
 */
define( 'WP_HOME', 'https://cms.satolocinsight.com' );
define( 'WP_SITEURL', 'https://cms.satolocinsight.com' );
define( 'FRONTEND_DOMAIN', 'https://satolocinsight.com' );

/* That's all, stop editing! Happy publishing. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

require_once ABSPATH . 'wp-settings.php'; 