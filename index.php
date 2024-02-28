<?php

// VARIABLES

$endpoint = 'https://cv.microservices.credy.com/v1';
$timestamp = time();
$sha_concat = sha1($timestamp . "credy");

// JSONX

// * first_name | string 255 - your first name
// * last_name | string 255 - your last name
// * email | string 255, must be a valid email address - your email address we can contact you by
// * bio | free text - introduction about yourself and why you would be a great fit for the position
// * technologies | array - the technologies you master ex. PHP, HTML, docker
// * timestamp | integer - current unix timestamp, deviation of +/-10 seconds is allowed
// * signature | string 255 - SHA1 hash of concatenation of current unix timestamp and the word "credy"
// * vcs_uri | string 255 - public git repository url where the solution to the puzzle is hosted

$data = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<json:object xsi:schemaLocation="http://www.datapower.com/schemas/json jsonx.xsd"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:json="http://www.ibm.com/xmlns/prod/2009/jsonx">
    <json:string name="first_name">Raikko</json:string>
    <json:string name="last_name">Prants</json:string>
    <json:string name="email">raikko.prants@gmail.com</json:string>
    <json:string name="bio">I'm a junior software developer. I'm graduating Tartu Vocational School this year. During my studies and passion/hobby projects, I have learned many things about development. For example, I started out wanting my main focus to be on front-end development, but the more I made projects and learned about languages, I found out that I enjoy back-end development so much more. I don't know if it's the idea of everything needing to be secure, or that it's the most important part because without a back-end, what good can a front-end application do? Now, I do want to be honest in this bio and not paint myself as someone I'm not. I have experience in PHP, but I'm not the best at it. I have a lot to learn, and I want to learn. I want to learn algorithms, security, data structures, and everything on a deeper level than I do now. And if I'm not as well experienced as some others who might apply to this job, I promise I have the willpower and motivation to learn and better myself to be a valuable asset to the team. Now, if we go a bit further from development, you'll find that I am quite open of a person. I love teamwork and talking to people, I love jokes, I love nature, and one of my many hobbies is following animal tracks in the forest and trying to catch the slightest glimpse of the animal. I hope that you read through everything and saw me as someone who might be worth joining your team. If not, then I really do hope that our paths cross again in the future. Thank you for reaching out to me from CVKeskus with the offer. Fair warning not the best singer ;D</json:string>
    <json:array name="technologies">
        <json:string>PHP</json:string>
        <json:string>MySQL</json:string>
        <json:string>JavaScript</json:string>
        <json:string>HTML</json:string>
        <json:string>CSS</json:string>
        <json:string>Java</json:string>
        <json:string>OOP</json:string>
        <json:string>REST</json:string>
    </json:array>
    <json:number name="timestamp">$timestamp</json:number>
    <json:string name="signature">$sha_concat</json:string>
    <json:string name="vcs_uri">https://github.com/RaikkoP/JSONX-API-POST</json:string>
</json:object>
XML;

echo $data;

// API POST REQUEST

$curl = curl_init($endpoint);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/xml'
));

$response = curl_exec($curl);

if (!$response) {
    echo 'Error: "' . curl_error($curl) . '"';
} else {
    echo 'Response HTTP Status Code : ' . curl_getinfo($curl, CURLINFO_HTTP_CODE) . PHP_EOL;
    echo 'Response HTTP Body : ' . $response . PHP_EOL;
}

curl_close($curl);
