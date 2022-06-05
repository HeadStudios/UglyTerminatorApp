<?php

require_once("wp-load.php"); // Make sure there are enough dot dot dots
require("connects.php");
require("env.php"); // this is in Gitignore for security reasons, ask me for access and I can provide
require("parsedown.php"); // This is the convert AirTable rich text field to HTML to pass to new WP post function

/* In the section below I comment the line for file_get_contents if I am testing so I could supply my own data and check output to speed up development. Makes sense?
Below I will include format currently sent from AirTable to update the array for testing
const data = { title: blogTitle, function: 1, excerpt: 'The short version', content: wpContent };
Also this is where I will define all the variables to be used 
*/
// Comment out the 3 lines below and uncomment everything underneath when doing testing directly at endpoint (vs sending from AirTable)
//$data = json_decode(file_get_contents('php://input'), true);

$temp_data = '{"title":"John Connor Returns","name":"Sarah Connor","function":1,"excerpt":"The short version","content":"This was generated with a beautiful shortlink. \n\nIt\'s because the woods are scary.\n\nThankfully - now you have... CATARACTS!\n\nWith cataracts you will be\n\n- Scared all the time\n- Never know what to do\n- Always try to find your way\n\nCataracts - sold where all **goods are sold!** \n","bannerhead":"Amazing Offer","headline":"Cataract Appointments Available","subheadline":"Your Doctor Will See You Now","cta_text":"Book your Cataracts Form","cta_link":"https://airtable.com","short_path":"for-you-michael-160"}';
$data = json_decode($temp_data, true);


// Below is just some code because I've noticed AirTable rich text formatting doesn't work if I have custom code - I need to test to see if I can remove this and have it still work
//$double_q = array('"');
//$content = str_replace($double_q, '\"', $content);
/*
$data = array("title" => "Bob the Builder", "function" => 1, "excerpt" => "The short version", "content" => "<h1>Big Content</h1><ul><li>One time</li><li>Two time</li></ul>");
$data['title'] = "Bob the Builder";
$data['function'] = 1;
$data['excerpt'] = "The short version";
$data['content'] = "<h1>Big Content</h1><ul><li>One time</li><li>Two time</li></ul>";
$data['bannerhead'] = "We are here as a test";
$data['headline'] = "Do not fear";
$data['subheadline'] = "Just testing some waters";
$data['content'] = '<h1>Big Content</h1><ul><li>"One time"</li><li>Two time</li></ul>';
$data['cta_text'] = "Just testing some waters";
$data['cta_link'] = "https://google.com";
$data['short_path'] = "now-you-see-it";
$content = $data['content'];
*/
$Parsedown = new Parsedown();
$content = $Parsedown->text($data["content"]);



/* This is just a proof of concept of being able to call a specific function based on what data is passed... I know it seems but I'm just learning!
Also... this is still technically part of the code even though the need to call a separate function based on arguments passed is not currently required */
if($data["function"] == 1){
$arr = array('server' => 'This is the first', 'ashram' => $data["title"], 'hilltop' => 'Let us begin', 'machine' => 'And dance to dancers', 'array' => 'Unless we are human');
} 
if($data["function"] == 2){
$arr = array('server' => 'And this is the second', 'ashram' => $data["title"], 'hilltop' => 'Let us begin', 'machine' => 'And dance to dancers', 'array' => 'Unless we are human');
} 

$ai_vid = robotUprising($data['name']);

$wp_custom = array (
    'fields' => array (
        'bannerhead' => $data["bannerhead"],
        'headline' => $data["headline"],
        'subheadline' => $data["subheadline"],
        'cta_text' => $data["cta_text"],
        'cta_link' => $data["cta_link"],
        'synthesia_id' => $ai_vid

    )
); 


/* AirTable passes a variable called 'function' - depending on the number passed the execution of this script will alter. Not sure of another way to do this
at this point. But basically
1. This is my first standard 'code' - and this will create a new custom post, with some custom fields and (eventually) a custom banner
2. This will be the actual sending of the SMS message... 
*/


// Note in this section I comment out bannerCreate and set uid directly to avoid API data limits (as Bannerbear only allows like 30 API calls on the trial)
//$uid = bannerCreate($data["name"]);
//$uid = bannerCreate($data["name"]);
$uid = '9e2VGL0qn6VVnr4m6EAv5mxr1';
$newPost = newCustomPost($data["title"], $content); 
$newPostResults = json_decode($newPost, true);
$arr['url'] = $newPostResults['guid']['rendered'];
$id = $newPostResults['id'];
customFieldPush($id, $wp_custom);

// Commenting out banner creation to save on API calls

//$uid = '9e2VGL0qn6VVnr4m6EAv5mxr1';


//$arr['shortlink'] = short_It($arr['url'], $data['short_path']);
$link_result = short_it($arr['url'], $data['short_path']);
$arr['shortlink'] = $link_result['shortURL'];
$image_url = getBearImage($uid);
echo "And we have an Image URL field and it is: ".$image_url." do you see it?";
OGLinkStatus($link_result['idString'], $data['name'], $data['excerpt'], $image_url);



//$arr = newCustomPost($data["title"]);
//$arr = json_decode($arr, true);
//var_dump($arr);
//echo "And the URL is: ".$arr['guid']['rendered'];


echo json_encode($arr);




