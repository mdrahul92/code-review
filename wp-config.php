<?php


/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */
define( 'WP_HOME', 'http://relish-2.local' );
define( 'WP_SITEURL', 'http://relish-2.local' );
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', "local" );

/** Database username */
define( 'DB_USER', "root" );

/** Database password */
define( 'DB_PASSWORD', "root" );

/** Database hostname */
define( 'DB_HOST', "localhost" );

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
define( 'AUTH_KEY',         'x4QKoxx-e-|K9.k_Jf_>l7,zGR6;^$L6[<1IG,^hSC$3},,;6&IcHE_R$-(yazi[' );
define( 'SECURE_AUTH_KEY',  'wus;pCD9j%2}qr^.^jZ,&8olGe7MV+lt=;_VAE-GpV2e&MtG)iy9J3m/dz~E.igo' );
define( 'LOGGED_IN_KEY',    '8{Fw~0hws<tG^Mn|K]EYr>f1^aeRW,i#H-Lu4+k)CK<y~pywGnGOUT1<+1n-Z]I2' );
define( 'NONCE_KEY',        'S~.O68Y_K*~iQ]EN1*a<IX`3nME@)o+-Uv_ +DZyMXP-JRGkM=?s3?-2=+ONwJ`G' );
define( 'AUTH_SALT',        'Y_+s()8y! X>8h5:W9))GauA%PrB.~aWSi[3yrUGr9[JicwCYc=>$OH4CQ@lDZro' );
define( 'SECURE_AUTH_SALT', '{%keVG1kFd-r#QoC^SYvUkba)nPgEN&M&*.bO4<yW7BTI>Il)O``>>r`ncne8D>*' );
define( 'LOGGED_IN_SALT',   'd(7G!.=_zWT0s0X,@(ly-&!GynhRs+a!3e0;8ekf1hf,0`_8?=sH,QEPsRX5&^Ch' );
define( 'NONCE_SALT',       'd!V%|j=%LkJmWc&~8w9;1m]`]!%TiL55tP8;G8Bi]#q0G)7sxu3$x!CR5]1#We=m' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */
define('GOOGLE_MAPS_API_KEY', 'AIzaSyCY0CJmZpF0JcbDRi26voHM39rmy-Hyy8s');

//@ini_set('display_errors', E_ALL);

define( 'DUPLICATOR_AUTH_KEY', '9E9KEnosFcD=}<w %/2/?(d@U/XGKn%x%fxYT5g5YD/r|QoL4yHCAuG}lJ*kfrKq' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname(__FILE__) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
