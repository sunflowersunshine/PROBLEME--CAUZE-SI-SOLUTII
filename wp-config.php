<?php

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'tech2050_wp163' );

/** MySQL database username */
define( 'DB_USER', 'tech2050_wp163' );

/** MySQL database password */
define( 'DB_PASSWORD', ']R045SHp]1' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '21n7xwkxdgbetkpuhpbfboqiphnyif1etyjix6jknaprukz5x2vnjzvwq0ckuq88' );
define( 'SECURE_AUTH_KEY',  '7kroc2ncytbprs1wldh3w3yiywfeukepta40miiczgqvsns48xq7pso4g43oqqic' );
define( 'LOGGED_IN_KEY',    '14pyap4icnsh1wkwpdfzr8sadxivsmpr1qmkz3fi30va8g8oiskgbuejjioxssti' );
define( 'NONCE_KEY',        'ovumnta5nbavsezvhql65tmaibc29f70udueaqt2wew0xtbu5uqsejncr5xagvq9' );
define( 'AUTH_SALT',        '4bcunt5q1h9vf4h2fdygxmyeto2fohl83zinvimpmjyfy2qaejzdmijdon21pxew' );
define( 'SECURE_AUTH_SALT', 'vnaweiwasge4s8ztkadzbitcuqiv5sv51etqzrxcw4qjvjs73yixntwqcutvpfky' );
define( 'LOGGED_IN_SALT',   'bhg7aagrmgkeeht82fa6zx9buotnfh71jxlde1v9xcpkiablzygazixjylv480fk' );
define( 'NONCE_SALT',       'tz4cdzvpmz3gdtw6ezars1ij6kn6hmqvdro6vvzkalsnqucbuqwrgsdt3pwl3zcq' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wped_';

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
define( 'WP_DEBUG', true);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
