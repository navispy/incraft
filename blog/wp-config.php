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
define( 'AUTH_KEY',         '&0L/}_d;DcQPGDirnR.=7lXE|%|Ex(vOw;xmLXlc0&%BbHbq~0]aM!?sOU~+90`$' );
define( 'SECURE_AUTH_KEY',  '9=w&G!9cFDYil3X{bML5,lM0$Z`/=8V>HeY)^Qx=_:z;RFuZYw,I(mbDueQ+##/p' );
define( 'LOGGED_IN_KEY',    '`s7P3x_$*fZH9xVIQ1k0o(FzcbD_$8E1Pir:_4)6/qeIJ&<w?TBw}rOcr7$_@P2_' );
define( 'NONCE_KEY',        'Cz,!ui4m2lXhFP63^(I4oMC[I3iUt&~Qo&g?zC/?EVL!~i*k[2q,LK8q:6dG_8,j' );
define( 'AUTH_SALT',        'gFCTl9FX*s~uA3i>GJGVv|nG`@SB42+([}N(eSg[Jxs{rp>;:Yg!YpflA;Ggbv8p' );
define( 'SECURE_AUTH_SALT', 'ADoA!%wpvw:3bVx^LC)U^43iiWQl48nyg[8k{#s/OruSH1y0TNjcR<H#pC7G$WP#' );
define( 'LOGGED_IN_SALT',   'UAwOKM6cH4e@=ueM-#tDs^m30vO7;cvALiVI1$ Y=9vz_@3qSF[4E5 |hQn>gv2@' );
define( 'NONCE_SALT',       '!;H)|}Fh*;bhHh?Z``n3AnRW~TP6_9Ep{rJ-^^y06pT_-m.]h:=kaz,/@:AZCR$4' );

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
