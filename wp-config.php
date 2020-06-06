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
define( 'DB_NAME', 'dbcodemaker' );

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
define( 'AUTH_KEY',         '^q^jeQA/nj9R>)6(rzXVL]ycBGRdB`I)aPYdCsg7d-egN~rmd2)t=t^^:;QHgW*s' );
define( 'SECURE_AUTH_KEY',  't4u/`S1{Oe2$#?<qo0N/qN0rom-|7~8;RyCCbV:{~Es.G|>`}quP,.m+V.4krOgF' );
define( 'LOGGED_IN_KEY',    '?3>1zsJ!36z8/f#)E!N@0?|m]#1LbE3C4o*4wk$L94bKgc{ATP#h|?j|t-kt0[^E' );
define( 'NONCE_KEY',        '|cL3#&jDM/13Stwqilo,1W;1hy%B-u.<j9Rx)?!]+&`{.6XbC%_u84n_VvMd4R6|' );
define( 'AUTH_SALT',        ']lr@d{dFBKZCA>S&J-kxN/XYncy!tIEiR1F5EP3L%7.TJ7m1Z6;fm oD`S>chljd' );
define( 'SECURE_AUTH_SALT', 'Z6%+#D/qj^i>>!wiop?}qq&y#(#%BFB3KDL :-?*PZ9t(M3Q8n5,v|{I4w3?ru(^' );
define( 'LOGGED_IN_SALT',   '.)e.Sb%e8JO}#N+!zBG_@#J{Qh+5NZ4wEH|/d9|9j6;8:,BNQ|YM[(mK(}*`NNtF' );
define( 'NONCE_SALT',       '[OW={iY<{;OyDPT+X`s_@TWD8<k kal$MJ~1Hxtb+nRl,;9H7m_,+dpmacBll;=!' );

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
