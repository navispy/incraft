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
define( 'DB_NAME', 'incraft_blog' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'DellGL#5100' );

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
define( 'AUTH_KEY',         '9#`u(eYO.__>:hQhFWI.D?RsfWHxG;y74xZSX)O>S~L_Qa93kpO} S3RwX._KUr;' );
define( 'SECURE_AUTH_KEY',  'xsqE`@xml>>4Yw)hSd %gSn n;%hJqOajOo&b0kFDtf,,+<Wx.M@B2#a%s`!*kAv' );
define( 'LOGGED_IN_KEY',    '1-0$8QI5IFrLT-&_QH_uM3@WQ^R[.l-B[;=4d.9F_x{k%FNCV?D)~,hc4.82t@Im' );
define( 'NONCE_KEY',        '[n)H0g01MD52-&V&ynzxif[}Wl[OR Y~+y-@Q1Wiexd*Yc!NanO)Bq&I/iR&e){]' );
define( 'AUTH_SALT',        'D2*YD;),*(Ry~m~~JQS%/;m/I48YnnQUyGUr# ]hrP7;yLA`g`o5*d_?H]wPz`9O' );
define( 'SECURE_AUTH_SALT', '|VnIMJ<F)18u4[c0Q;st(L[|qeve$fnHL@TPC0lv=^wR06R~FMGAi$>lw.o*PHF3' );
define( 'LOGGED_IN_SALT',   't}#iZz.EnTG}k0n6|4KK(A|h8!D~f5D<#c;]K=F)lIE+BKxtE%JH-GdoJe}xjO1h' );
define( 'NONCE_SALT',       'pe$(fK=qsw3z^3&Lw3EAO|pQPll_y.9nqv8ak 5NXibL]Fux$,8,i6enkuNB>y;_' );

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

