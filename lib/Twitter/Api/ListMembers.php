<?php

namespace Twitter\Api;

use \Twitter\Api;

/**
 * List Members Methods
 *
 * @package Twitter
 * @subpackage Api
 * @author Jonathan H. Wage <jonwage@gmail.com>
 */
class ListMembers extends Api
{
    public function getMembers($id)
    {
        if ( ! strstr($id, '/')) {
            $id = $this->client->getUsername() . '/' . $id;
        }

        return $this->get(sprintf('%s/members', $id));
    }

    public function addMember($id, $username)
    {
        if ( ! is_numeric($username)) {
            $user = $this->getUser($username);
            $id = $user->id;
        } else {
            $id = $username;
        }
        return $this->post(sprintf('%s/%s/members', $this->client->getUsername(), $id), array(
            'id' => $id
        ));
    }

    public function deleteMember($id, $username)
    {
        if ( ! is_numeric($username)) {
            $user = $this->getUser($username);
            $id = $user->id;
        } else {
            $id = $username;
        }
        return $this->delete(sprintf('%s/%s/members', $this->client->getUsername(), $id), array(
            'id' => $id
        ));
    }

    public function isMember($id, $username = null)
    {
        if ( ! strstr($id, '/')) {
            $id = $this->client->getUsername() . '/' . $id;
        }

        $username = $username ? $username : $this->client->getUsername();

        $result = $this->get(
            sprintf('%s/members/%s', $id, $username)
        );
        return isset($result->error) ? false : true;
    }
}