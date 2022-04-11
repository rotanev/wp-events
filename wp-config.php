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
define( 'DB_USER', 'user' );

/** Database password */
define( 'DB_PASSWORD', '12345' );

/** Database hostname */
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
define( 'AUTH_KEY',         '(8@{~f+G4>?ur-L4{D1]bY8.55>6o0bq|S<OKxans2l+aZzgPuy/<&46K@;F&<nr' );
define( 'SECURE_AUTH_KEY',  'wc4!9yoS_1RUjwx*@5AW^d?t*F)kKxD-C:*eQvhtL>xgn}LYo+dWhO;%o,^Z7K^G' );
define( 'LOGGED_IN_KEY',    '.=^YhVrYGx$1mBG^-[B}D^|| g]YzTYf%W34GHb`|y$A Pfw%A(q?UKK)_zOtUuJ' );
define( 'NONCE_KEY',        '&k2xt%Wc*Nh<P8+w#Lx?Zk+OU1(%]$#>:P@VI;T=TL>R.:mOZu`c}G?tk_dh&O(M' );
define( 'AUTH_SALT',        '1eZBG< 55;~vySkQMbSd]K=8.Vx*-W8RA%DCr(0_><X.k`1+<Znr2;3Bh*n]zmV-' );
define( 'SECURE_AUTH_SALT', ',)D-g/*{_Xu>Edvol!+l6|nFFOe<!O69rQ|:s3 4D#/(Ug)}5*n&ryL G-ce91B{' );
define( 'LOGGED_IN_SALT',   'ks&si0Rw`.`;gGC+o }Nc$Fh28u&1.7Bo4A?VH&l`QB}b}wXaa5W2=-gqL$vu)VK' );
define( 'NONCE_SALT',       ':Hf.5:)CAgpz,z7IBQAJYqD?{$l<rhzqQF&jWvn* ;|=?j~F%*^R.6nW@k`YX)!,' );

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
