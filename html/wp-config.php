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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wordpress' );

/** MySQL database password */
define( 'DB_PASSWORD', '75f5fe104af281e8992d16741d92eea80d6b603ff7a42a3a' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         '5lnH^v)@~C-?VLEJ-.>r^1_ll<<=*0A6czTSgTO#u+<F#]EI}b@3h10D:9EW:.>k' );
define( 'SECURE_AUTH_KEY',  ',e2h_w$Ctli6FHuLjbkU}J7m-v|!e$<^`! 4kqEL&]qUn^:}6w3<)D/3=-P<M(XX' );
define( 'LOGGED_IN_KEY',    '/mFf=C3,Jt)`>|<P+bz29h h[`G53sN,#;K[a9j-X.N#aYxT78LB8GN~y<F&s!,t' );
define( 'NONCE_KEY',        'T=b8C 5_hlT5k)fwG5*z3)dE>Jx`l`Vf`uIfKL&D>M#~fYsH6xe;b#Pai3LJp3.K' );
define( 'AUTH_SALT',        'P#XGztr2Mbq)qe?{AOPWvp(8,LZfv!DwwrP8j- m!37V:xYqV`6zwvdmx1+9>[)D' );
define( 'SECURE_AUTH_SALT', 'ozAA$S:v/W*<2P#t|&h`scY&Yds6a$xCuuF{23X?9k$^-h`6X~.{w!7ntG6ER`pk' );
define( 'LOGGED_IN_SALT',   '~S#w<Lzf2#~ Pp{ue#AKR`L=Gq=S|K@gka#/g$$2[H-Fl$N9X:iMsqagy%VvM-[;' );
define( 'NONCE_SALT',       '$+:Z<4:oM mBXkm:;3|CRFB[Ek p3Iy<X.KXzJYjXb~wtV]MAs=4O?E0HO}C48tY' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
