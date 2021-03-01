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
define( 'DB_NAME', 'wordpress_plugins_basic' );

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
define( 'AUTH_KEY',         '>nz 4T<8TNT3dHEebJOF)v`>#rbbp6{t8&rb>r{p+Sr4TMi^@(a->Cn^O2mOBoR=' );
define( 'SECURE_AUTH_KEY',  'fgds(BUS5kEu:BqvICMF mMHJxdCHC_-Ly[e1Av#u<SJh%0,~Po@>%gE{[l+%9_f' );
define( 'LOGGED_IN_KEY',    '3dSaGxhC-:TDh5&b[u;ESzba,*hmWlDjwg q%.ZlbJS2v}SM5i;Xk ap0.f=oFT2' );
define( 'NONCE_KEY',        '`ly})vtFR[WWR67|*MOT6~bhiXnrp|l-qzx2e4^?3U@QhQWMX:)wc$mF9$Q#%|TP' );
define( 'AUTH_SALT',        '>*J1PfF41`lVaJCCGCc)rnJ5]-}+=;$p6NX+T 4)2S$bs#*gE5% >7=8!&SNUQz=' );
define( 'SECURE_AUTH_SALT', '~Qdbt:8#%~([y~*:US:=r_CR4Be(`EQf$`Iy#ShvcSqro&e2Z+<$Knoh@tX9n}0r' );
define( 'LOGGED_IN_SALT',   '6oG<Cof(IvO~0W2|kxO5{^UhEe.ku <G#yBUv0d.Dte?[OkOOHfRRKSzKa],)@UL' );
define( 'NONCE_SALT',       '{:E0Z9?5WaucxoNV`}vGX#2s*_[0@7_dn;adxzE_f>Gg*zWCE::=Ty)1M?3V|a2N' );

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
