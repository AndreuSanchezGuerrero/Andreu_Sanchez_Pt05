<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../../config/database/connection.php';
include_once BASE_PATH . 'controllers/sessions/CustomSessionHandler.php';
require_once BASE_PATH . 'vendor/autoload.php';

use Hybridauth\Hybridauth;

try {
    $config = [
        'callback' => 'https://kelsier.cat/controllers/auth/hybridAuth-providers/providersController.php',
        'providers' => [
            'GitHub' => [
                'enabled' => true,
                'keys' => [
                    'id' => 'Ov23li5VQi87R8w9wrnj',
                    'secret' => '7f782821ce297cbae864dbe0359f492abddfd83a', 
                ],
                'scope' => 'user:email', 
            ],
        ],
    ];

    $hybridauth = new Hybridauth($config);

    $adapter = $hybridauth->getAdapter('GitHub');
    $adapter->authenticate();

    $userProfile = $adapter->getUserProfile();

    CustomSessionHandler::set('user_id', $userProfile->identifier);
    CustomSessionHandler::set('email', $userProfile->email);
    CustomSessionHandler::set('username', $userProfile->displayName);
    CustomSessionHandler::set('avatar', $userProfile->photoURL);
    CustomSessionHandler::set('login_success', 'Welcome ' . $userProfile->displayName . '!');

    header('Location: ' . BASE_URL . 'index.php');
    exit();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
