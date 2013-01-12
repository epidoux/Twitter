<?php

namespace Twitter\Client;

/**
 * OAuth Twitter client
 *
 * @package Twitter
 * @subpackage Api
 * @author Jonathan H. Wage <jonwage@gmail.com>
 */
class OAuth extends AbstractClient
{
    private $oAuth;
    private $token;

    public function __construct($consumerKey, $consumerSecret, $signatureMethod = OAUTH_SIG_METHOD_HMACSHA1, $authType = OAUTH_AUTH_TYPE_URI)
    {
        $this->oAuth = new \OAuth($consumerKey, $consumerSecret, $signatureMethod, $authType);
        $result = $this->oAuth->getRequestToken('https://twitter.com/oauth/request_token');
        $this->oAuth->setToken($result['oauth_token'], $result['oauth_token_secret']);
        // How can we get the username?
    }

    protected function doFetch($url, array $data = array(), $method = 'get')
    {
        $this->oAuth->fetch($url, $data, $method);
        return $this->oAuth->getLastResponse();
    }
}