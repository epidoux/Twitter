# PHP 5.3 Twitter Client

[![Build Status](https://secure.travis-ci.org/jwage/Twitter.png?branch=master)](http://travis-ci.org/jwage/Twitter)

*By Jonathan H. Wage*

## Intialize Client

Use the HTTP client:

    $client = new \Twitter\Client\HTTP('username', 'password');

Or you can use the OAuth client:

    $client = new \Twitter\Client\OAuth('consumer_key', 'consumer_secret');

## Api

The API of the twitter client is organize in the same way as the Twitter API 
itself. The calls are split into groups so we have classes for each group.

All that is required is you instantiate it and pass the instance of a client
to use.

You can use the base Api to issue requests manually, but it is recommended you
use the specific API described in the next sections.

Here is an example where we manually use the Api class to issue requests:

    $api = new \Twitter\Api($client);
    $results = $api->post('statuses/update', array('status' => 'my new status'));

This is the same as doing this:

    $statuses = new \Twitter\Api\Statuses($client);
    $statuses->updateStatus('my new status');

### Account

Instantiate an instance:

    $account = new \Twitter\Api\Account($client);

Below are the methods available:

* $account->verify($username = null, $password = null)
* $account->getRateLimitStatus()
* $account->endSession()
* $account->updateDeliveryDevice($device)
* $account->updateProfileColors($colors)
* $account->updateProfileImage($imagePath)
* $account->updateProfileBackgroundImage($imagePath, $tile = false)
* $account->updateProfile(array $profile)

### Blocks

Instantiate an instance:

    $blocks = new \Twitter\Api\Blocks($client);

Below are the methods available:

* $blocks->blockUser($username)
* $blocks->deleteBlock($username)
* $blocks->isBlocking($username)
* $blocks->getBlockedUsers()
* $blocks->getBlockedIds()

### Direct Messages

Instantiate an instance:

    $dms = new \Twitter\Api\DirectMessages($client);

Below are the methods available:

* $dms->getMostRecent()
* $dms->getSent()
* $dms->sendMessage($to, $message)
* $dms->deleteMessage($id)

### Favorites

Instantiate an instance:

    $favorites = new \Twitter\Api\Favorites($client);

Below are the methods available:

* $favorites->getMostRecent($username = null)
* $favorites->createFavorite($id)
* $favorites->deleteFavorite($id)

### Friendships

Instantiate an instance:

    $friendships = new \Twitter\Api\Friendships($client);

Below are the methods available:

* $friendships->follow($username)
* $friendships->unfollow($username)
* $friendships->exists($usernameA, $usernameB = null)
* $friendships->isFollowing($username)
* $friendships->isFollowedBy($username)
* $friendships->getFriendship($usernameA, $usernameB = null)

### List Members

Instantiate an instance:

    $listMembers = new \Twitter\Api\ListMembers($client);

Below are the methods available:

* $listMembers->getMembers($id)
* $listMembers->addMember($id, $username)
* $listMembers->deleteMember($id, $username)
* $listMembers->isMember($id, $username = null)

### Lists

Instantiate an instance:

    $lists = new \Twitter\Api\Lists($client);

Below are the methods available:

* $lists->createList($name, $mode = 'public')
* $lists->updateList($id, $name, $mode = 'public')
* $lists->getLists($username = null)
* $lists->getList($id, $username = null)
* $lists->deleteList($id)
* $lists->getStatuses($id, $username = null)
* $lists->getMemberships($username = null)
* $lists->getSubscriptions($username = null)

### List Subscribers

Instantiate an instance:

    $listSubscribers = new \Twitter\Api\ListSubscribers($client);

Below are the methods available:

* $listSubscribers->getSubscribers($id)
* $listSubscribers->subscribe($id)
* $listSubscribers->unsubscribe($id)
* $listSubscribers->isSubscriber($id, $username = null)

### Notifications

Instantiate an instance:

    $notifications = new \Twitter\Api\Notifications($client);

Below are the methods available:

* $notifications->enable($username)
* $notifications->disable($username)

### Saved Searches

Instantiate an instance:

    $savedSearches = new \Twitter\Api\SavedSearches($client);

Below are the methods available:

* $savedSearches->getSavedSearches()
* $savedSearches->getSavedSearch($id)
* $savedSearches->createSavedSearch($query)
* $savedSearches->deleteSavedSearch($id)

### Social Graph

Instantiate an instance:

    $socialGraph = new \Twitter\Api\SocialGraph($client);

Below are the methods available:

* $socialGraph->getFriendIds($username = null)
* $socialGraph->getFollowerIds($username = null)

### Statuses

Instantiate an instance:

    $statuses = new \Twitter\Api\Statuses($client);

Below are the methods available:

* $statuses->getPublicTimeline()
* $statuses->getFriendsTimeline()
* $statuses->getUserTimeline()
* $statuses->getMentions()
* $statuses->getStatus($id)
* $statuses->updateStatus($status)
* $statuses->deleteStatus($id)
* $statuses->getUserFriends($username)
* $statuses->getUserFollowers($username)

### Search

Instantiate an instance:

    $search = new \Twitter\Api\Search($client);

Below are the methods available:

* $search->find($q, $options = array(), $iteratePages = false)
* $search->getTrends()
* $search->getCurrentTrends($excludeHashTags = false)
* $search->getDailyTrends(\DateTime $date, $excludeHashTags = false)
* $search->getWeeklyTrends(\DateTime $date, $excludeHashTags = false)