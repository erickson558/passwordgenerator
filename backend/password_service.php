<?php

function get_app_version() {
    $versionFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'VERSION';
    if (is_readable($versionFile)) {
        $value = trim(@file_get_contents($versionFile));
        if ($value !== '') {
            return $value;
        }
    }

    return 'V0.0.0';
}

function random_byte_value() {
    // Fallback para servidores donde OpenSSL no esta habilitado.
    if (function_exists('openssl_random_pseudo_bytes')) {
        $strong = false;
        $byte = openssl_random_pseudo_bytes(1, $strong);
        if ($byte !== false && strlen($byte) === 1) {
            return ord($byte);
        }
    }

    return mt_rand(0, 255);
}

function pick_random_char($str) {
    $len = strlen($str);
    if ($len === 0) {
        return '';
    }

    return $str[random_byte_value() % $len];
}

// Genera password segura evitando caracteres problematicos para SOAP/XML.
function generate_password($length) {
    $length = max(4, min(20, (int)$length));

    $lower = 'abcdefghijklmnopqrstuvwxyz';
    $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $digits = '0123456789';
    $special = '!#$%()*+-=.,_:;';

    $all = $lower . $upper . $digits . $special;

    $chars = array(
        pick_random_char($lower),
        pick_random_char($upper),
        pick_random_char($digits),
        pick_random_char($special),
    );

    for ($i = 4; $i < $length; $i++) {
        $chars[] = pick_random_char($all);
    }

    shuffle($chars);

    return implode('', $chars);
}
