<?php

namespace App\Delivery;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class Move24Api implements ApiInterface
{
    const TIMEOUT      = 30;
    const API_LOGIN    = [
        'type' => 'POST',
        'url'  => '/login/device.json',
    ];
    const API_SCHEMA   = [
        'type' => 'GET',
        'url'  => '/delivery/schemas.json',
    ];
    const API_DELIVERY = [
        'type' => 'POST',
        'url'  => '/delivery.json',
    ];

    /** @var  Client */
    protected $client;

    /** @var  string */
    protected $apiUrl;

    /** @var  string */
    protected $username;

    /** @var  string */
    protected $password;

    /** @var  array */
    protected $cookies = [];

    /** @var  string */
    protected $authToken;

    public function __construct(
        string $apiUrl,
        string $username,
        string $password,
        ?string $cookieName,
        ?string $cookePassword
    ) {
        if (!filter_var($apiUrl, FILTER_VALIDATE_URL)) {
            throw new \Exception('Not valid api url');
        }

        $this->apiUrl   = $apiUrl;
        $this->username = $username;
        $this->password = $password;

        if ($cookieName && $cookePassword) {
            $this->cookies = [$cookieName => $cookePassword];
        }

        $this->client = new Client(
            [
                'base_uri'        => $this->apiUrl,
                'cookies'         => true,
                'request.options' => [
                    'timeout'         => self::TIMEOUT,
                    'connect_timeout' => self::TIMEOUT,
                ],
            ]
        );
    }

    /**
     * Get schemas
     *
     * @throws \Exception invalid request
     * @return array
     */
    public function getSchemas(): array
    {
        $response = $this->client->request(
            self::API_SCHEMA['type'],
            self::API_SCHEMA['url'],
            [
                'cookies' => $this->getCookieJar(),
            ]
        );

        if ($response->getStatusCode() == 200) {
            $resp = json_decode($response->getBody(), true);
            return $resp;
        }

        throw new \Exception('Request schema error');
    }

    /**
     * Get cookies
     *
     * @param bool $needAuth - checkAuth
     *
     * @return CookieJar
     */
    protected function getCookieJar(bool $needAuth = true): CookieJar
    {
        if ($needAuth && !$this->authToken) {
            $this->login();
        }

        if ($this->authToken) {
            $this->cookies['token'] = $this->authToken;
        }

        $parseApiUrl = parse_url($this->apiUrl);
        $cookieJar   = CookieJar::fromArray($this->cookies, $parseApiUrl['host']);

        return $cookieJar;
    }

    /**
     * Login
     *
     * @throws \Exception invalid request
     * @return void
     */
    protected function login(): void
    {
        $cookieJar = $this->getCookieJar(false);
        $response  = $this->client->request(
            self::API_LOGIN['type'],
            self::API_LOGIN['url'],
            [
                'cookies'     => $cookieJar,
                'form_params' => [
                    'username' => $this->username,
                    'password' => $this->password,
                ],
            ]
        );

        if ($response->getStatusCode() == 200) {
            $this->authToken = $cookieJar->getCookieByName("token")->getValue();
            return;
        }

        throw new \Exception('Request login error');
    }

    /**
     * Create delivery
     *
     * @throws \Exception invalid request
     * @return array
     */
    public function createDelivery(array $delivery): array
    {

        $response = $this->client->request(
            self::API_DELIVERY['type'],
            self::API_DELIVERY['url'],
            [
                'cookies'     => $this->getCookieJar(),
                'form_params' => $delivery,
            ]
        );

        if ($response->getStatusCode() == 200) {
            $resp = json_decode($response->getBody(), true);
            return $resp;
        }

        throw new \Exception('Request delivery error');
    }
}
