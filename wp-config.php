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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'topscmcg_learnladder' );

/** Database username */
define( 'DB_USER', 'topscmcg_dbadmin' );

/** Database password */
define( 'DB_PASSWORD', 'studio!@#' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'wI2n6?nq_W!i;p*uU`CHk:|>!Pv$3DI>Xgv7lXaO/OQn?>Sz`e#%,R&(D^StNt5^' );
define( 'SECURE_AUTH_KEY',   '7*$xku`f|]+((P:(Y%&sjR`KX`:$UET,.- IkyaoxHQBKd#da1ec(Gjii,!%xOWQ' );
define( 'LOGGED_IN_KEY',     'Ee~gWTGcb{jls-Nhaj07O<O;p@Ozw8W*1$mm%(%KA~*^5K4/UiSpb|:wL 6GweN6' );
define( 'NONCE_KEY',         '6~|j9T+Gq_VBQ9p,aC]-dM~)onb-}vz.;l>IM!!|w{ x+BC0U9,HGW`/+e2=8[C%' );
define( 'AUTH_SALT',         'h%G+c.4JVNG[2iiVc2Cz*wMQU`LL>2@H>TZb t|jBp^hqqfn?YCL3Td>.x;Q,y_G' );
define( 'SECURE_AUTH_SALT',  'VgH.(4P5oJzsW8|/4NEB._G:Zn{;E&e*;bAc1$)7CJC>9E>in|Lyt/cfjp?)<5-B' );
define( 'LOGGED_IN_SALT',    '<}7*uc~dm68sL2#0H}y>8wVPEw6nKXrlAuog:E58T=pa)9O(k<ByCJ(6>jS$yu>x' );
define( 'NONCE_SALT',        'cT@lMVGxC{ f&KukIru 8nMNLc|=LyG$6?T*|8]Ue1|{^Q0e_BfV NOp5`+#M/WV' );
define( 'WP_CACHE_KEY_SALT', 'ljP-AN$!{I*%$_q>e-D;2FXS0G/T+k#xGb#C`TpB0upyfD5vXiN`8moLOQ!.RK>k' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

@ini_set( 'upload_max_size' , '50M' );
@ini_set( 'post_max_size', '200M');
@ini_set( 'memory_limit', '200M' );

/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
