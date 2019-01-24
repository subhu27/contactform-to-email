<?php

/*

Plugin Name: Su-Contact-Form

Plugin URI: https://github.com/subhu27/contactform-to-email

Description: Simple contact form 
Version: 1.0

Author: Suraj Bhusal

Author URI: www.surajbhusal.com.np

*/

    
//require_once (ABSPATH.'/wp-content/plugins/su-cont-form/sudbase.php');

//sur_install();


function cont_form() {

    echo '<form action="' . esc_url($_SERVER['REQUEST_URI'] ) . '" method="post">';

    echo '<p>';

    echo 'Your Name * <br />';

    echo '<input type="text" name="contf-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["contf-name"] ) ? esc_attr( $_POST["contf-name"] ) : '' ) . '" size="40" />';
    $contf_name = $_POST["contf-name"];

    echo '</p>';

    echo '<p>';

    echo 'Your Email * <br />';

    echo '<input type="email" name="contf-email" value="' . ( isset( $_POST["contf-email"] ) ? esc_attr( $_POST["contf-email"] ) : '' ) . '" size="40" />';
    $contf_email = $_POST["contf-email"];

    echo '</p>';

    echo '<p>';

    echo 'Subject *<br />';

    echo '<input type="text" name="contf-subject" pattern="[a-zA-Z ]+" value="' . ( isset( $_POST["contf-subject"] ) ? esc_attr( $_POST["contf-subject"] ) : '' ) . '" size="40" />';
    $contf_subject = $_POST["contf-subject"];

    echo '</p>';

    echo '<p>';

    echo 'Your Message * <br />';

    echo '<textarea rows="10" cols="35" name="contf-message">' . ( isset( $_POST["contf-message"] ) ? esc_attr( $_POST["contf-message"] ) : '' ) . '</textarea>';
    $contf_message = $_POST["contf-message"];

    echo '</p>';

    echo '<p><input type="submit" name="contf-submitted" value="Send"/></p>';

    echo '</form>';

}









//end of contact form







function deliver_mail() {



    // checks if the submit button is clicked

    if ( isset( $_POST['contf-submitted'] ) ) {



        // sanitize form values

        $sender_name    =  $_POST["contf-name"];

        $sender_email   = $_POST["contf-email"];

        $subject = $_POST["contf-subject"];

        $message = $_POST["contf-message"];



        // gets the default administrator email address

        $to_admin = get_option( 'admin_email' );



        $headers = "From: $sender_name <$sender_email>" . "\r\n";



        // Display email sent message status
        if ( wp_mail( $to_admin, $subject, $message, $headers ) ) {


            echo '<div><p>Thank you, we received your message. We will get back to you as soon as possible.</p></div>';

        } else {

            echo 'An unexpected error occurred';

        }

    }

}









function contf_bind() {

    ob_start();

    deliver_mail();

    cont_form();



    return ob_get_clean();

}

add_shortcode( 'contact-to-email', 'contf_bind' );







?>