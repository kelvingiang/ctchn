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
define( 'DB_NAME', 'ctchn' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'V1Y>.EBL2I!O)Dg4]s&0E^VIxx<lbFvx%:E+Nfu[[93H:J?Rtge^~Hk5AY0,WPcj' );
define( 'SECURE_AUTH_KEY',  'zz01>TStEDV]la y5;L^wj+-&e3Wol?TJoM3Ls?M,=R#[vx7CJCw(&rfT4 u=re5' );
define( 'LOGGED_IN_KEY',    'vqx3LlQ54?c1.AH}jaiGR)5|KQkS@w0V7Q16$Z{x:,@kZ/^;Sj4U9x}72{c0CM,]' );
define( 'NONCE_KEY',        '8IhjzD^0Tx,wI[tD*k_&$dn,u5q3@f[x#(F+Btp{}.Nu+18h2sQ}`2}OgVPcoKd^' );
define( 'AUTH_SALT',        'z+k0}TB;3#}kK1wD0B+cDKL4<p R~SW?Yv%P7ar^eH$HC)4^)`83TK>/U,+3RzCB' );
define( 'SECURE_AUTH_SALT', 'W 6J7X/SWg7/cD9.PoO]}{utz` c@K|K(K[,g/%*|&bpu[y-e$Y(iODY1k1~%Yjj' );
define( 'LOGGED_IN_SALT',   'C=_(p+Ci`WP3a>}$[EH@FNos)3<NsQ_L]Ra+C{<^/kt.<@cD.oe2yIP~cirCQ_0$' );
define( 'NONCE_SALT',       'o[~s)pkUjIeAO8oS~ki8zYui*~(bGw&l>jA.6S!6|!?Q* ~Pz8K30R(@IkL}92$x' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wphn_';

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
