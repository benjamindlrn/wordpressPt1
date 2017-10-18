<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpressuser');

/** MySQL database password */
define('DB_PASSWORD', 'password');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/** */
define('FS_METHOD','direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */

define('AUTH_KEY',         '_|l&p||2-d7AQ?p+<]Go?6U=(8i0_zBNqH5Ou$jOYyDV+h:jB=m!]C(N/bSU9c|X');
define('SECURE_AUTH_KEY',  'H7l&@,m9LISr;:wT*Q&u|yUTb-g9c[5oVj(c_8mW_h!7GgK(6nd-5[HXO+l).bsj');
define('LOGGED_IN_KEY',    'OiZ5r?&/|U1S8aLA6D,^K0S:}.PifJ;rXyU0 )t)JX-sjN?A0|_-><2I|T3*IWR#');
define('NONCE_KEY',        'zMU1R&5t2N:`j0-a?s>FJ_5}%Z<?4-J?=Ns<mpE/@^mG[E:4Qn<#lWU2oe`PgpdR');
define('AUTH_SALT',        ')Xa)?WHRtf2VQ v_m11iXIkSX+P<~t5e_`60yw_;; {V=9&fhuU=<U-t[/t<GPa,');
define('SECURE_AUTH_SALT', 'P&)Qtg4&Ta)=o%V,{/}-9o*({waEt~h&(=Tz_leVF0ZY#`+L<el(3S>$Fb`|]!ts');
define('LOGGED_IN_SALT',   '+XFj#X>{K7k7!(p&aFjC9i&&n[a-` ;)grX:l[*RYuwtE;EM~|$)K?frqt?B,1ed');
define('NONCE_SALT',       'xEJ480A*ovNRHuFrK|e:T);P[W<XpCGw4h?eArzZ42*K_>n/Whg+@l:U7Dx--)M/');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
