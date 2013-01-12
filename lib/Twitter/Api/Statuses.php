<?php

namespace Twitter\Api;

use \Twitter\Api;

/**
 * Status Methods
 *
 * @package Twitter
 * @subpackage Api
 * @author Jonathan H. Wage <jonwage@gmail.com>
 */
class Statuses extends Api
{
    private $nextCursor = '-1';
    private $nextPage = 1;

    public function getPublicTimeline()
    {
        return $this->get('statuses/public_timeline');
    }

    public function getFriendsTimeline($iteratePages = false)
    {
        if ($iteratePages) {
            return $this->getPaginatedByPageNum('statuses/friends_timeline');
        } else {
            return $this->get('statuses/friends_timeline');
        }
    }

    public function getUserTimeline($iteratePages = false)
    {
        if ($iteratePages) {
            return $this->getPaginatedByPageNum('statuses/user_timeline');
        } else {
            return $this->get('statuses/user_timeline');
        }
    }

    public function getMentions($iteratePages = false)
    {
        if ($iteratePages) {
            return $this->getPaginatedByPageNum('statuses/mentions');
        } else {
            return $this->get('statuses/mentions');
        }
    }

    public function getStatus($id)
    {
        return $this->get(sprintf('statuses/show/%s', $id));
    }

    public function updateStatus($status)
    {
        return $this->post('statuses/update', array(
            'status' => $status
        ));
    }

    public function deleteStatus($id)
    {
        return $this->delete(sprintf('statuses/destroy/%s', $id));
    }

    public function getUserFriends($username, $iteratePages = false)
    {
        if ($iteratePages) {
            return $this->getPaginatedByCursor(sprintf('statuses/friends/%s', $username));
        } else {
            return $this->get(sprintf('statuses/friends/%s', $username));
        }
    }

    public function getUserFollowers($username, $iteratePages = false)
    {
        if ($iteratePages) {
            return $this->getPaginatedByCursor(sprintf('statuses/followers/%s', $username));
        } else {
            return $this->get(sprintf('statuses/followers/%s', $username));
        }
    }

    private function getPaginatedByPageNum($path, array $data = array())
    {
        if ($this->nextPage === false) {
            return false;
        }

        $data['page'] = $this->nextPage;

        $results = $this->get($path, $data);

        if ($results) {
            $this->nextPage++;
        } else {
            $this->nextPage = false;
        }

        return $results;
    }

    private function getPaginatedByCursor($path, array $data = array())
    {
        if ($this->nextCursor === false) {
            return false;
        }

        $data = array();
        $data['cursor'] = $this->nextCursor;

        $results = $this->get($path, $data);

        $this->nextCursor = $this->client->getNextCursor();

        return $results;
    }
}