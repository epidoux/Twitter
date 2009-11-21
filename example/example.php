<?php

require '../lib/Twitter/ClassLoader.php';

if ( ! isset($_REQUEST['q'])) {
  $_REQUEST['q'] = null;
}
$errors = array();

function prepareTweet($tweet)
{
  $tweet = preg_replace('/@([A-Za-z0-9]+)/', '<a href="http://www.twitter.com/$1">@$1</a>', $tweet);
  return $tweet;
}

$classLoader = new \Twitter\ClassLoader('Twitter');
$classLoader->setIncludePath('../lib');
$classLoader->register();

if ($_POST) {
    $client = new \Twitter\Client\HTTP($_POST['username'], $_POST['password']);
    $account = new \Twitter\Api\Account($client);
    if ( ! $account->verify()) {
        $errors[] = 'Invalid credentials';
    }
} else {
    $client = new \Twitter\Client\HTTP('apiunittest', 'changeme');
}

if (empty($errors)) {
  if ($_POST) {
      $statuses = new \Twitter\Api\Statuses($client);
      $result = $statuses->updateStatus($_POST['comment'] . ' ' . $_REQUEST['q']);
  }
}

$search = new \Twitter\Api\Search($client);
$statuses = $search->find($_REQUEST['q'], $_REQUEST);
$nextPage = $search->getNextPage();
$previousPage = $search->getPreviousPage();

include 'example.tpl.php';