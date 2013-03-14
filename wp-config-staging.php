<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'academy.dev');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'toor');

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
define('AUTH_KEY',         'GNBgl/H)-tJ:u%:=[b8]cf+C[lV-R/U|P8dW?g -?c(:IbzHRzS/(jm54OG[oG14');
define('SECURE_AUTH_KEY',  'eQ,{<ki:YZT7<3_g}XhlP5erN>HWo^>_XP@[RcW.5-W!&f#1FD/8EYPLX}bj-UtH');
define('LOGGED_IN_KEY',    'A+4HTPzAF<:ac(3/-Z1PC0p3zVXsJFC`F+|-D[G+P:$7nKyu<.<(S5mz}-jsB)]-');
define('NONCE_KEY',        'RJ*KeKZCfQBY:ux+_-KQMs4`=.37qV1;A6iZ!}AveQCUkqd|e7,)`OML01%XmMc ');
define('AUTH_SALT',        'j8^k[vF%Sqh,fa+7?P7y.pzSk&2deko%:=!fb1TW{-[!/}I%|^Y.F>AZ_c6:/=U0');
define('SECURE_AUTH_SALT', 'b!%0U(a-*-FpC>0bfeh0WK$+$;kxoz]m3))0[AiyzJZ; UJ/(olaxXW}l=c=_*y|');
define('LOGGED_IN_SALT',   '?W(#bv|1?]bwbu6)IvT#6I3Ggi/4aX_)6YiVA7X<BWxYuBiYHXVSx8<I9:J|uXN ');
define('NONCE_SALT',       'JWAHqsjB!Q;DqqC-x?Aa]Mgy.E/>)R(<et1C7dVL>JnFETqbG`NP:0qsS4V?a$9g');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

