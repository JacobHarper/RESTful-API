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
Midterm

curlProcess.php

The goal of this file is to accept the data and sumbit a response back to the user
*/

if(isset($_POST)) {

/*
    Test to see if curlProcess is recieving the data from process.php

    echo "First Name: {$_REQUEST['fname']}<br>";
    echo "Last Name: {$_REQUEST['lname']}<br>";
    echo "E-Mail Address: {$_REQUEST['email']}<br>";
    echo "Home Phone: {$_REQUEST['hphone']}<br>";
    echo "Mobile Phone: {$_REQUEST['mphone']}<br>";
    echo "Street Address: {$_REQUEST['street']}<br>";
    echo "City: {$_REQUEST['city']}<br>";
    echo "State: {$_REQUEST['state']}<br>";
    echo "Zipcode: {$_REQUEST['zipcode']}<br>";
*/

    //Request the variables from process.php for use in curlprocess
    $fname = $_REQUEST['fname'];
    $lname = $_REQUEST['lname'];
    $email = $_REQUEST['email'];
    $hphone = $_REQUEST['hphone'];
    $mphone = $_REQUEST['mphone'];
    $street = $_REQUEST['street'];
    $city = $_REQUEST['city'];
    $state = $_REQUEST['state'];
    $zipcode = $_REQUEST['zipcode'];

    //Create an array in curlProcess using the variables from proccess.php
    $ansArray = array(
        "fname" => $fname,
        "lname" => $lname,
        "email" => $email,
        "street" => $street,
        "hphone" => $hphone,
        "mphone" => $mphone,
        "state" => $state,
        "city" => $city,
        "zipcode" => $zipcode);


    //Count the answers in the array:
    $count = count($ansArray);

    if(count = 9){

    //Echo out answers in array
    echo json_encode($ansArray);

    }

} else {
    exit("An Error Occured");
}

?>
