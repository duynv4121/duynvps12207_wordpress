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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'C:\xampp\htdocs\wordpress\wp-content\plugins\wp-super-cache/' );
define( 'DB_NAME', 'wp_demo' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '&rR5E#Gxp9g]d:Zm%g;=n!Of&dScmU9b6#6d)$RC_?d`*o-wnY@uf:+I@]LlqD0P' );
define( 'SECURE_AUTH_KEY',  'SH^&@-=1f|}<nw=eW~=5y%9;3vV#*483U5*36jdoX2)A}0ca1OO<qU8CmO>HCCDA' );
define( 'LOGGED_IN_KEY',    '8`HV[%61@{G&(4!%$NoOm}Uud$n@/vq n`8`z2gj:Gt>{EMLcC**:WaNrX(G{wm,' );
define( 'NONCE_KEY',        'O-KKr&nkY*[{R0X0nQLc62Z4xF4HN-yS)NSw>~nMBXP~^]9#>=Oq}Un_g94VOB|)' );
define( 'AUTH_SALT',        '0!]V;FQzGOmwn7V`#buOw<%5T]WGl<s6v8Mo[$yy^Gv.P >dP8;G5*+Rg:>^|o.q' );
define( 'SECURE_AUTH_SALT', ';A]*:w>?Jk*A+S0s3BC~fEj(B7b/NOW[W.)lhDh!V>-l|}v;vXBtV8 P[?BTy]V]' );
define( 'LOGGED_IN_SALT',   'W;YwVg[U3APnjPU:*9>?K6&{J,<fpcsGo^ebtLI&;%%W3QQQIJNi7uob!rDxpz6H' );
define( 'NONCE_SALT',       'I]7@%F-><{}Dn>b[G)jYzL4];_]ncw9I^-t59Bsf%Y1udiLoa+zm*H90K2): PEV' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
