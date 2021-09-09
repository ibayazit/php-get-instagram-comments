<?php

require __DIR__ . '/vendor/autoload.php';

use Phpfastcache\Helper\Psr16Adapter;
use InstagramScraper\Instagram;

$username = 'USERNAME';
$password = 'PASSWORD';

$post_code = "POSTCODE";
$comment_count = 10;

$instagram = Instagram::withCredentials($username, $password, new Psr16Adapter('Files'));
$instagram->login();
$instagram->saveSession();
$comments = $instagram->getMediaCommentsByCode($post_code, $comment_count);

$data = [];

foreach($comments as $comment){
    $owner = $comment->getOwner();
    $data[] = [
        "Id" => $comment->getId(),
        "Text" => $comment->getText(),
        "Owner" => [
            "Username" => $owner->getUsername(),
            "ProfilPicture" => $owner->getProfilePicUrl()
        ]
    ];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);