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
define('DB_NAME', 'wp');

/** MySQL database username */
define('DB_USER', 'uwp');

/** MySQL database password */
define('DB_PASSWORD', 'cwp');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'd0e]?tt:% |Zyoo#]Kb]s>!,T@}Z_LthyqA)s/*}+[g?)|,a #zqt n2enY(A xG');
define('SECURE_AUTH_KEY',  'b5bna*umU(v0t1AzUkJsyuxt~Dv(,Qu2[og2?v+`j1A/zqa2vKdy6#[?drt<|O%g');
define('LOGGED_IN_KEY',    '9e n5xQaocnh:;7hxUfRO}P~k6,m_loEz@wWZO/1w180X[s95Lj*5`~QvE`3|D^D');
define('NONCE_KEY',        'Z=_hv]_`;p6YtE[>@==3qR9mTL`sxGC?0CDVOz46OOOt<DJ]Ds&<=-~>>aH%aM-b');
define('AUTH_SALT',        'J<e5`K+`TF^=45b)9$$Cetld<APQ:A2L-<S2+a1qmcYKL9qfHd8N.xZug)n0kd8g');
define('SECURE_AUTH_SALT', '$i^_s,B|~gb#P)>NHGzT*:TXxX1<?`>-Ch*]pp4{q`a V-xL]A,TcUy$)h!HV*Ry');
define('LOGGED_IN_SALT',   'L@LhJ7@6wAFL_I-# 1~+~H;*${71?1X|+3havg0xVU%>,7$NHx8&{6Ta6isZ;T.A');
define('NONCE_SALT',       'xK}VzSabal,mU0@FR+y+UZ5bD7CQEg~,aCg yA1>c41!_A!eYz:d{* *)rl]3#D7');

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
