<?php

namespace Twitter\Api;

use \Twitter\Api;

/**
 * Search Methods
 *
 * @package Twitter
 * @subpackage Api
 * @author Jonathan H. Wage <jonwage@gmail.com>
 */
class Search extends Api
{
    private $nextPage;
    private $previousPage;
    protected $apiBaseUrl = 'http://search.twitter.com';

    public function getNextPage()
    {
        return $this->nextPage;
    }

    public function getPreviousPage()
    {
        return $this->previousPage;
    }

    public function find($q, $options = array(), $iteratePages = false)
    {
        if ($this->nextPage === false) {
            return false;
        }

        if ($iteratePages && $this->nextPage) {
            $results = $this->get(sprintf('search%s', $this->nextPage), $options);
        } else {
            $results = $this->get(sprintf('search?q=%s', $q), $options);
        }

        if (isset($results->next_page) && $results->next_page) {
            $this->nextPage = $results->next_page;
        } else {
            $this->nextPage = false;
        }

        if (isset($results->previous_page) && $results->previous_page) {
            $this->previousPage = $results->previous_page;
        } else {
            $this->previousPage = false;
        }

        return $results;
    }

    public function getTrends()
    {
        return $this->get('trends');
    }

    public function getCurrentTrends($excludeHashTags = false)
    {
        $data = array();
        if ($excludeHashTags === true) {
            $data['exclude'] = 'hashtags';
        }
        return $this->get('trends/current', $data);
    }

    public function getDailyTrends(\DateTime $date, $excludeHashTags = false)
    {
        $data = array(
            'date' => $date->format('Y-m-d')
        );
        if ($excludeHashTags === true) {
            $data['exclude'] = 'hashtags';
        }
        return $this->get('trends/daily', $data);
    }

    public function getWeeklyTrends(\DateTime $date, $excludeHashTags = false)
    {
        $data = array(
            'date' => $date->format('Y-m-d')
        );
        if ($excludeHashTags === true) {
            $data['exclude'] = 'hashtags';
        }
        return $this->get('trends/weekly', $data);
    }
}