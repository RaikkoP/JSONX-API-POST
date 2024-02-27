<?php

// VARIABLES
$endpoint = 'https://cv.microservices.credy.com/v1';
$current_time = time();
$hashing_word = "credy";
$sha_concat = sha1($current_time . $hashing_word);


// JSONX
$data = <<<XML
    <?xml version='1.0' standalone='yes'?>
    <schema xmlns="http://www.jsonx.org/schema-0.4.xsd">
        <object>
            <property xsi:type="string" pattern="^[a-z][A-Z][a-zA-Z]{2,255}$" name="first_name" value="Raikko"/>
            <property xsi:type="string" pattern="^[a-z][A-Z][a-zA-Z]{2,255}$" name="last_name" value="Prants"/>
            <property xsi:type="string" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,255}$" name="email" value="raikko.prants@gmail.com"/>
            <property xsi:type="string" pattern="^[a-z][A-Z][a-zA-Z]$" name="bio"
            value=""/>
            <property name="technologies" xsi:type="array">
                <string>PHP</string>
                <string>MySQL</string>
                <string>JavaScript</string>
                <string>HTML</string>
                <string>CSS</string>
                <string>Java</string>
                <string>OOP</string>
                <string>REST</string>
            </property>
            <property xsi:type="number"><?php echo $current_time; ?></property>
            <property xsi:type="string" name="signature"><?php echo $sha_concat; ?></property>
        </object>
    </schema>
XML;

echo $data;
echo $sha_concat;

// * first_name | string 255 - your first name
// * last_name | string 255 - your last name
// * email | string 255, must be a valid email address - your email address we can contact you by
// * bio | free text - introduction about yourself and why you would be a great fit for the position
// * technologies | array - the technologies you master ex. PHP, HTML, docker
// * timestamp | integer - current unix timestamp, deviation of +/-10 seconds is allowed
// * signature | string 255 - SHA1 hash of concatenation of current unix timestamp and the word "credy"
// * vcs_uri | string 255 - public git repository url where the solution to the puzzle is hosted
