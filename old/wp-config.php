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
define('DB_USER', 'wordpress_1');

/** MySQL database password */
define('DB_PASSWORD', '6B25wvcCV$');

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
define('AUTH_KEY',         'rDbI9lnGhY20Yhm^rMdPP7CF#SXcSoNS!xWj&X8P4G92AJ5i79A&9dYSbpa(T271');
define('SECURE_AUTH_KEY',  'U2ZJftiV5VAuqXDf#gIX9ML4O(%J87pY8rd&kPTwl(7QwbifgQ#aLxzkLkoOP9!O');
define('LOGGED_IN_KEY',    'zU*tE*9ysRKZO5AixHz&M3JV5d*dadF@xK28HHxrP!vTrLYg#LNR0JoSsY6C0mL^');
define('NONCE_KEY',        'E)I)w7sX)m(@WW7%YiHNmOWER2RHYc@uG0prgnjvPQE9VM549AiiDEkdOMk#NWHf');
define('AUTH_SALT',        'K3xlI*xuuP)2poz(P&FX*5EQOMGq*en2iUzr3Adon@ddcg3cmyEilcbDF^#^IQq*');
define('SECURE_AUTH_SALT', 'D)6fYiqauk1j2A9^7I9z8hTEhn4ae7kIcI61BKDBN8B1ur6RLZXwhL2L0&*VoT&Q');
define('LOGGED_IN_SALT',   'xtJBafG^3R*UQe@EzjCRbd*p(8EPS5)kDV(OV&9LaoYlIEgVWR&h4fKc%%BH8sb2');
define('NONCE_SALT',       'bXtuHuF2jfXPyDtcxDpuzqz4g)TxKtewbonRvdg*2onbm(&Xoh5Yu(qfv9yCECvW');
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