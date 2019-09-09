<?php
define ( "HASH_SALT", "YourSecretSaltToChange" );

define ( 'DB_SERVER', 'localhost' );
define ( 'DB_USER', 'root' );
define ( 'DB_PASS', '' );
define ( 'DB_NAME', 'assoc' );
define ( 'DB_DRIVER', 'mysql' );
define ( 'DB_PORT', '3306' );

define ( 'TBL_USERS', 'users' );
define ( 'TBL_ACTIVE_USERS', 'active_users' );
define ( 'TBL_ACTIVE_GUESTS', 'active_guests' );
define ( 'TBL_BANNED_USERS', 'banned_users' );
define ( 'TBL_MAIN_USERS', 'maintenance_users');

define ( 'TBL_DEPT', 'department' );
define ( 'TBL_COMPLAINT', 'complaint' );
define ( 'TBL_TASK', 'task' );

define ( 'TBL_CATEGORY', 'cat_settings' );
define ('TBL_COMP','cat_comp');
define ('TBL_SPEC','cat_spec');
define ('TBL_CONC','cat_conc');

define ( 'ADMIN_NAME', 'semos2016' );
define ( 'GUEST_NAME', 'guest' );

define ( 'ADMIN_LEVEL', 9 );
define ( 'MASTER_LEVEL', 8 );
define ( 'EXPERT_LEVEL', 7 );
define ( 'USER_LEVEL', 1 );
define ( 'GUEST_LEVEL', 0 );

define ( 'TRACK_VISITORS', true );

define ( 'USER_TIMEOUT', 10 );
define ( 'GUEST_TIMEOUT', 5 );

define ( 'COOKIE_EXPIRE', 60 * 60 * 24 * 100 );
define ( 'COOKIE_PATH', '/' );

define ( 'EMAIL_FROM_NAME', 'admin' );
define ( 'EMAIL_FROM_ADDR', 'admin@localhost' );
define ( 'EMAIL_WELCOME', true );

define ( 'ALL_LOWERCASE', false );