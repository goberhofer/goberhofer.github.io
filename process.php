<?php
if( isset($_POST) ){
     
    //form validation vars
    $formok = true;
    $errors = array();
     
    //sumbission data
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    $date = date('d/m/Y');
    $time = date('H:i:s');
     
    //form data
    $firstname = $_POST['firstName'];
    $lastname = $_POST['lastName'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
     
    //form validation to go here....
     

     //send email if all is ok
    if($formok){
        $headers = "From: contact@graceoberhofer.com" . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         
        $emailbody = "<p>You have recieved a new message from the contact form on your website.</p>
                      <p><strong>Name: </strong> {$firstName} {$lastName} </p>
                      <p><strong>Email Address: </strong> {$email} </p>
                      <p><strong>Enquiry: </strong> {$subject} </p>
                      <p><strong>Message: </strong> {$message} </p>
                      <p>This message was sent from the IP Address: {$ipaddress} on {$date} at {$time}</p>";
         
        mail("sarika.halarnakar@gmail.com","New Enquiry",$emailbody,$headers);
         
    }

    $returndata = array(
        'posted_form_data' => array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'enquiry' => $enquiry,
            'message' => $message
        ),
        'form_ok' => $formok,
        'errors' => $errors
    );

        //if this is not an ajax request
    if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest'){
        //set session variables
        session_start();
        $_SESSION['cf_returndata'] = $returndata;
         
        //redirect back to form
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }
}