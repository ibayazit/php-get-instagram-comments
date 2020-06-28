<?php
require __DIR__ . '/vendor/autoload.php';
use Phpfastcache\Helper\Psr16Adapter;
use InstagramScraper\Instagram;

$instagram_post_code = "CB96aFmAEqf";
$instagram_comment_row_count = 10;

$instagram = new \InstagramScraper\Instagram();
$comments = $instagram->getMediaCommentsByCode($instagram_post_code, $instagram_comment_row_count);
$listArr = [];
foreach($comments as $k=>$c):
    $owner = $c->getOwner();
    $x = [
        "Id" => $c->getId(),
        "Text" => $c->getText(),
        "Owner" => [
            "Username" => $owner->getUsername(),
            "ProfilPicture" => $owner->getProfilePicUrl()
        ]
    ];
    $listArr[] = $x;
endforeach;
echo json_encode($listArr);