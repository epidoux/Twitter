<?php

namespace Twitter\Client;

/**
 * Abstract Twitter client class
 *
 * @package Twitter
 * @subpackage Api
 * @author Jonathan H. Wage <jonwage@gmail.com>
 */
abstract class AbstractClient implements Client
{
    protected $username;
    protected $nextCursor;

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getNextCursor()
    {
        return $this->nextCursor;
    }

    public function fetch($url, array $data = array(), $method = 'get')
    {
        if ($method == 'delete') {
            $data['_method'] = 'DELETE';
        }

        if ($method == 'get' && ! empty($data)) {
            $sep = strstr($url, '?') ? '&' : '?';
            $url = $url . $sep . http_build_query($data);
        }

        $json = $this->doFetch($url, $data, $method);

        preg_match('/"next_cursor":(.*),/', $json, $matches);
        if (isset($matches[1]) && $matches[1] && $matches[1] != $this->nextCursor) {
            $this->nextCursor = $matches[1];
        } else {
            $this->nextCursor = false;
        }

        return json_decode($json);
    }

    abstract protected function doFetch($url, array $data, $method);
}