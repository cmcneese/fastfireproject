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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'T5FLEr29vpGZcDJUSLJB/CLj3uG0TM1TTeJvd5vTGqGnh5Or1erS6+xZiGisuwIDTB27gul7Dd2TyGe8ZiFs8A==');
define('SECURE_AUTH_KEY',  '4Aa0upRA7LQTFmUbLrVNey9rvYjci/cCYEr7f3UN3XwNGHE5YM2dVWHExd2ER2YT62++9hAXjXUtu6QT+iXTqg==');
define('LOGGED_IN_KEY',    'V3NvVPP7K+UVmKTAwUTr5I/Q2qr1Xq16bTFr0jCLoiNVqiH4jegXOud6WPOci3V/Qll4O6fKIIqGuByelOdJlw==');
define('NONCE_KEY',        'neug/a/rMgkact/nWEll0rQuMlRon0vFhzAfriOWHGSzZmGaO6HCWkNRJKAXPdB45Hwn/QuFft2UL9x4v8/jZQ==');
define('AUTH_SALT',        'GI+HyyA04m68vE4h0qW+c6DDlBWmloP9cEjIASPfM62s4q4QKny9Hrv9pORbfWo77bbCJP8lfbJ5Zum86iKARw==');
define('SECURE_AUTH_SALT', 'AGp5yhJ4uzMQjEppw4y/qTXLzWPUv8qL1DANHUV3wdiPsRE9uw0PIKSrkbTlkBZ8Lm14Ec47WQIUU0pg1H43iA==');
define('LOGGED_IN_SALT',   'HWyy1omn5FYDo7qdcY06IkcphYe5rmNWleWD/6CmynVd62U8JnQHGfO2gQzWFKcy22SB0CU7tWlbvq1XCawAsA==');
define('NONCE_SALT',       'SiNG0CqlredApUPLnI5WrurryLv1X56sFDSq055FVV0aw+iV8506efXfhX027VRnMZU1cOnhQ5Nu/eOFY5wyug==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
