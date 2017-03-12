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
define('DB_PASSWORD', 'Sempron$44');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '$~x_>5mk(7{My21-pM_(9cDL}_s0aWql=*i&,=*44;,mt~e%5y1E%QiIVnW8gGWJ');
define('SECURE_AUTH_KEY',  'Y;=o-q/cO.(Pz(yU|hdtht|dPD+gWtF.Y|qPE^9_-64-FoxzSc{7yG4ga2>!Advc');
define('LOGGED_IN_KEY',    '#&?IzdG7cOw$Q^@D,t<s)0N.SGY=7j[lX}$kV-pj0<q&we@VyFSF;,8}[e0))mf-');
define('NONCE_KEY',        'VrrZ}gFex$gtkdO8>Ft61<V;9#fh6QrU|`bK`}-0sS.El$Ke-C<u,T+);^rQ? p%');
define('AUTH_SALT',        '}Tw$Bp9!zo#o/yHrMX:Zg|$k)<+NSE>/XL2D@#x)4>+GJEyyFm}E+rC!b?t|(i~x');
define('SECURE_AUTH_SALT', 'z%!()kV&%<[gNC=&/CG5MB-EG-1|lY0dh[77wH&uj/% +g5?L6Lg.BUXK9@Z`5ME');
define('LOGGED_IN_SALT',   '@bY!_._Di.%5#=q_n= J,FigrZ1VAgX(u*):4^8wi,q?uh-LHRo,o6wmk?8aQ@i`');
define('NONCE_SALT',       '(sO=|zT+tGO 4yZNS`O2S2y_J?=kUH*Lnd<7*VMDvD0^6Fl<#cvrhR-9!];s[0/V');
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
