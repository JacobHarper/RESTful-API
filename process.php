<?php
/*
 * 1. Process the form submission from index.php (using process.php), this includes verifying the data.
 *      In particular you should make sure the email address, home phone and mobile phone are formatted correctly.
 * 2. Setup a CURL call to curlProcess.php, using POST, which passes the information submitted by the form after validation.
 * 3. curlProcess.php should accept the data, verify that it is only the 9 fields, add a thank you message and reply to the CURL call (back to process.php) with a JSON
 * response, which includes the 9 pieces of data originally submitted and the thank you message.
 * 4. print out the whole JSON response in an HTML formatted way.
 *
 * NOTE: Please comment appropriately and add your name and description of what this script does in a comment
 */

/*
Jacob Harper
Midterm Project

process.php

The goal of this file is to process the form submission, verify the data, and setup a curl call
*/
if(isset($_POST)) {

    $street = $_POST["street"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $hphone = $_POST["hphone"];
    $mphone = $_POST["mphone"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zipcode = $_POST["zipcode"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //Create an error if illegal characters are used
        echo  "There was an issue with your email. Please make sure it is formatted properly.";
    }

    else if(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $hphone)) { //Create an error if illegal characters are used
        echo "The was a formatting error with the home phone number entered";
    }

    else if(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $mphone)) { //Create an error if illegal characters are used
        echo "The was a formatting error with the mobile phone number entered";
    }

    else{

    //The next block of code uses curl to create an array of variables that contain the answers to the form, and postthem for use in curlProcess
    $curlIn = curl_init();//Create a variable curlIn
    $curlURL = 'http://10.10.6.148:8091/midterm/curlProcess.php'; //Create a variable that holds the URL for the curlProcess file
    $formFields = array( //Create an array of variables that contains the answers to the form
        'fname' => $fname,
        'lname' => $lname,
        'email' => $email,
        'street' => $street,
        'hphone' => $hphone,
        'mphone' => $mphone,
        'state' => $state,
        'city' => $city,
        'zipcode' => $zipcode);


    //Create a url-encoded query string from the formFields array
    $postVars = http_build_query($formFields);

    //The next block of code defines curl transport options
    curl_setopt($curlIn, CURLOPT_URL, $curlURL); //Defines the url($curlURL) to retrieve content from
    curl_setopt($curlIn, CURLOPT_POST, 1); //Makes sure the curl can post
    curl_setopt($curlIn, CURLOPT_POSTFIELDS, $postVars); //Posts all the variables

    $result = curl_exec($curlIn); //Pass the url to the browser
    curl_close($curlIn); //Close the curl
    $finalResult = json_decode($result, true); //Converts the string to an array

    //Test that the final result works
    //var_dump($finalResult);

    echo 'Thanks for filling out the form! Here is what you entered:';

    //Echo out the answers in a list form
    echo '<pre>';
    //Print the array without the word "array" at the top
    echo str_replace('Array','',print_r($formFields,true));
    echo '</pre>';

    /*
    Different attempts at getting the data to output using process instead of curlProcess:

    $data = file_get_contents($curlURL);
    $input = json_decode($data);
    echo $input[0]->name;

    echo json_encode($data);

    $ansArr = '{"fname":$fname, "lname":$lname, "email":$email, "street":$street, "hphone":$hphone, "mphone":$mphone, "state":$state, "city":$city, "zipcode":$zipcode}';
    $json = json_decode($ansArr, true);
    print_r($json);

    $result = curl_exec($curlURL);
    $result = json_decode($result, true);

    header('Content-Type: application/json');
    echo json_encode($results, JSON_PRETTY_PRINT);
*/

}
}
else {
    exit("An Error Occured");
}
?>
       