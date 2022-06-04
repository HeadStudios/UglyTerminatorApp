<?php

// This is where all the API connect scripts will go to make it easier to read

function newCustomPost($custom_title, $content) {

    $post_data = [
        "title" => $custom_title,
        "content" => $content,
        "excerpt" => "This is some short text",
        "status" => "publish"
    ];
    

    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, 'https://staging2.conveyancingqld.com/wp-json/wp/v2/for-you');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
    
    $headers = array();
    $headers[] = 'Authorization: Basic d2h5d29udHlvdWNvbm5lYHIDDEN';
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    
    //$id = $result['id'];
    //$json_result = json_decode($result);
    //return $json_result['link'];
    return $result;
    
}


function getBearImage($uid) {
// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.bannerbear.com/v2/images/'.$image['uid']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


$headers = array();
$headers[] = 'Authorization: Bearer bb_pr_e86cde3c8fHIDDEN';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

$array_result = json_decode($result, true);
$image_url = "";
$image_url = $array_result[0]['image_url'];
return $image_url; 

}

function customFieldPush($id, $url_array) { // still need to add custom field values

    $url = http_build_query($url_array);
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, 'https://staging2.conveyancingqld.com/wp-json/acf/v3/for-you/'.$id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $url);
    
    $headers = array();
    $headers[] = 'Authorization: Basic d2h5d29udHlvdWNvbm5lY3QHIDDEN';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    
    
    
    
    
}

function SMS_Voyage($text) {
    $ch = curl_init();
    
    $sms_data = [
        "from" => 'PHP Robot',
        "text" => 'Yes this is really coming from code',
        "to" => "61412826569",
        "api_key" => "d3e293a6",
        "api_secret" => "Z5eCowTwRDL0gU5i"
        
    ];
    
    
    
    curl_setopt($ch, CURLOPT_URL, 'https://rest.nexmo.com/sms/json');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($sms_data));
    
    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    var_dump($result);
    
    }

function short_It($url, $path) {
    $ch = curl_init();
    
    $short_data = [
        "allowDuplicates" => false,
        "domain" => '4a4y.short.gy',
        "originalURL" => $url,
        "path" => $path,
        "title" => "PHP Campaign [You Have Arrived]",
    ];
    
    curl_setopt($ch, CURLOPT_URL, 'https://api.short.io/links');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($short_data));
    
    $headers = array();
    $headers[] = 'Accept: application/json';
    $headers[] = 'Authorization: sk_GyqWOHIDDEN';
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    
    $array_result = json_decode($result, true);
    echo "URL IS: ";
    
    return $array_result['shortURL'];
    }

/*


// Create Banner

// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.bannerbear.com/v2/images?=');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"template\": \"A37YJe5qHIDDEN\",\n  \"modifications\": [\n    {\n      \"name\": \"avatar\",\n      \"image_url\": \"https://cdn.bannerbear.com/sample_images/welcome_bear_photo.jpg\"\n    },\n    {\n      \"name\": \"name\",\n      \"text\": \"Where is your mind\",\n      \"color\": null,\n      \"background\": null\n    },\n    {\n      \"name\": \"handle\",\n      \"text\": \"Something special\",\n      \"color\": null,\n      \"background\": null\n    },\n    {\n      \"name\": \"tweet\",\n      \"text\": \"Specialist handle\",\n      \"color\": null,\n      \"background\": null\n    }\n  ],\n  \"webhook_url\": null,\n  \"transparent\": false,\n  \"metadata\": null\n}");

$headers = array();
$headers[] = 'Authorization: Bearer bb_pr_e86cde3c8f92HIDDEN';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$image = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

$image_id = $image['uid'];

// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.bannerbear.com/v2/images/'.$image['uid']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


$headers = array();
$headers[] = 'Authorization: Bearer bb_pr_e86HIDDEN';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

$image_url = $result['image_url'];

*/



/*
// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
$ch = curl_init();

// Need to convert URL  to this: https%3A%2F%2Fconveyancingqld.com%2Fyour-referral-offer%2F&name=your-offer

curl_setopt($ch, CURLOPT_URL, 'https://cutt.ly/api/api.php?key=dd4e6982HIDDEN&short='.$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

$short_link = $result['url']['shortLink'];  

*/


/*


*/