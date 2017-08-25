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
define('DB_NAME', 'wordpress_f');

/** MySQL database username */
define('DB_USER', 'wordpress_7');

/** MySQL database password */
define('DB_PASSWORD', 'F1a05X_pgH');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

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
define('AUTH_KEY',         'cmW!CHhhztgU0(6(BUX70r2@Djl3tcssgNzWYl)zkN^888kQoO4SiFg0@JD84FVe');
define('SECURE_AUTH_KEY',  'pR%duRyPWl5iT#TMR8lAbwWnf%%P4#4Nj(@&#&4)YSz!wp*^1g&vwjVt(08Um3lT');
define('LOGGED_IN_KEY',    '^Y%#xQRhLtzO4*e!QSkg7YpC^oJv403oG@oX)X^V)FbUzk9%Hhor&CxSAQtefzS4');
define('NONCE_KEY',        'B24D0Wmc&uW7ZqQbMMGa3TWFhclZiPWLuqPmdRxXvdmMeYbsojAjmnd0S2zpdEOK');
define('AUTH_SALT',        'H#U(SBENEbIaIk^(u%su*Et&eVYuDQNy%oO!CK(r3p%xpKEN%PeKcbVSep%mbThj');
define('SECURE_AUTH_SALT', 'dNc%HqWa02Lccoan0M)rXP@07l&pWLXKj&YabG6@zi0ng6l@%4)CW1iV4wteepdg');
define('LOGGED_IN_SALT',   'RnM*Xob11OkOPs&stJ*R9c51ewPpe3YYMxXG&tfkF!Bp@xx#yhXbr7rB2HWOfbBD');
define('NONCE_SALT',       'mR%QTy%UDFJI3aJesKcx81V)JA%v!yY)a#a5BVOnlyi57CSXaqlviUuHNAFWtMRd');
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

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');
?>