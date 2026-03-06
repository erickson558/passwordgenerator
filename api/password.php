<?php

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'password_service.php';

$len = isset($_GET['length']) ? $_GET['length'] : 14;

header('Content-Type: application/json');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');

echo json_encode(array(
    'password' => generate_password($len),
    'version' => get_app_version(),
));
