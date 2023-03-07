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

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '2580' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/** 사용자 입력 부분 */
define("WP_CACHE", true);
//define('WPLANG', 'ko_KR');
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
define( 'AUTH_KEY',         'EGd!>fAKHM^xdxXT)%hU$J5kS|y*aN>5J?TR28gn-rXOqhdCGC-uI6+N/XtZ3o,l' );
define( 'SECURE_AUTH_KEY',  '{:APnYDcPLzTi/4UFG|@t1V&vda6q (H0Nr;TNT!_k^v<E{`d1=;]t(pqVdS/4;&' );
define( 'LOGGED_IN_KEY',    '{0`M Zhb&UZq^ex~<0Y?pOqW4_TH2[i,z0y]5Q=*ynxL]7-NP237a(&HBynWRqc`' );
define( 'NONCE_KEY',        '*1H/V$}V|.aM+G>b,t^y/-ZzY_|JI#,EYo+woL@4R80#w{]Pd*_E}ngJ1,/2vhWP' );
define( 'AUTH_SALT',        '&FLYReXOsT{U=b_;v5<FT]zv%AL{qB,!+nHq>LW*N|_($[*|*Eh[P<[il0oz8-lD' );
define( 'SECURE_AUTH_SALT', 'WCOH>2tdWe?Q|Jd0 qH 3pjxBG,:+4^I/%dqOtOi+-JNr&$lIK6.*}AL:w0drRt?' );
define( 'LOGGED_IN_SALT',   'ol%4`- :2.Un&O2,WTu^$&fw`7|$sPZ~}krEmZ6r3FsBRod~~#FV>~#PG3pF+cft' );
define( 'NONCE_SALT',       'tp#o;(| vW.4PGjM,C.}DbH(f2%4^f}EOgRUzFqb] tiaAY9|bl;,>=s#N!uLSf|' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_01';

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
