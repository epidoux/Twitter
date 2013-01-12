<?php

namespace Twitter\Api;

use \Twitter\Api;

/**
 * Lists Methods
 *
 * @package Twitter
 * @subpackage Api
 * @author Jonathan H. Wage <jonwage@gmail.com>
 */
class Lists extends Api
{
    public function createList($name, $mode = 'public')
    {
        return $this->post(sprintf('%s/lists', $this->client->getUsername()), array(
            'name' => $name
        ));
    }

    public function updateList($id, $name, $mode = 'public')
    {
        return $this->post(sprintf('%s/lists/%s', $this->client->getUsername(), $id), array(
            'name' => $name
        ));
    }

    public function getLists($username = null)
    {
        $username = $username ? $username : $this->client->getUsername();
        return $this->get(sprintf('%s/lists', $username));
    }

    public function getList($id, $username = null)
    {
        $username = $username ? $username : $this->client->getUsername();
        return $this->get(sprintf('%s/lists/%s', $username, $id));
    }

    public function deleteList($id)
    {
        return $this->delete(sprintf('%s/lists/%s', $this->client->getUsername(), $id));
    }

    public function getStatuses($id, $username = null)
    {
        $username = $username ? $username : $this->client->getUsername();
        return $this->get(sprintf('%s/lists/%s/statuses', $username, $id));
    }

    public function getMemberships($username = null)
    {
        $username = $username ? $username : $this->client->getUsername();
        return $this->get(sprintf('%s/lists/memberships', $username));
    }

    public function getSubscriptions($username = null)
    {
        $username = $username ? $username : $this->client->getUsername();
        return $this->get(sprintf('%s/lists/subscriptions', $username));
    }
}