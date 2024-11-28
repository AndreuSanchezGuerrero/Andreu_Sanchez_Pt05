<?php
require_once __DIR__ . '/../../config/env.php';
require_once BASE_PATH . 'vendor/autoload.php'; 

use Google\Service\Oauth2 as Google_Service_Oauth2;

class GoogleAuthController {
    private $client;

    public function __construct() {
        $config = include BASE_PATH . 'config/google.php';

        $this->client = new Google_Client();
        $this->client->setClientId($config['client_id']);
        $this->client->setClientSecret($config['client_secret']);
        $this->client->setRedirectUri($config['redirect_uri']);
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }

    public function getAuthUrl() {
        return filter_var($this->client->createAuthUrl(), FILTER_SANITIZE_URL);
    }

    public function handleCallback() {
        if (isset($_GET['code'])) {
            $token = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
            $this->client->setAccessToken($token);

            $googleService = new Google_Service_Oauth2($this->client);

            $userInfo = $googleService->userinfo->get();

            return [
                'id' => $userInfo->id,
                'email' => $userInfo->email,
                'name' => $userInfo->name,
            ];
        }

        return null;
    }
}
?>
