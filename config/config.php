
<?php
error_reporting(E_ALL & ~E_DEPRECATED);
if (!defined('PROJECT_PATH')) {
    define('PROJECT_PATH', 'http://localhost/PHP-MYSQL-PROJECT'); // replace this value with your project path
}

if (!defined('IS_SANDBOX')) {
    define('IS_SANDBOX', true); // 'true' for sandbox, 'false' for live
}

if (!defined('STORE_ID')) {
    define('STORE_ID', 'lms694f54a49aec0'); // your store id. For sandbox, register at https://developer.sslcommerz.com/registration/
}

if (!defined('STORE_PASSWORD')) {
    define('STORE_PASSWORD', 'lms694f54a49aec0@ssl'); // your store password.
}

return [
    'success_url' => 'pg_redirection/success.php', 
    'failed_url'  => 'pg_redirection/fail.php', 
    'cancel_url'  => 'pg_redirection/cancel.php', 
    'ipn_url'     => 'pg_redirection/ipn.php',

    'projectPath' => PROJECT_PATH,
    'apiDomain' => IS_SANDBOX ? 'https://sandbox.sslcommerz.com' : 'https://securepay.sslcommerz.com',
    'apiCredentials' => [
        'store_id' => STORE_ID,
        'store_password' => STORE_PASSWORD,
    ],
    'apiUrl' => [
        'make_payment' => "/gwprocess/v4/api.php",
        'order_validate' => "/validator/api/validationserverAPI.php",
    ],
'connect_from_localhost' => true,
    'verify_hash' => true,
];
