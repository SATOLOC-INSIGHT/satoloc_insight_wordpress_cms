<?php
ini_set('error_reporting', E_STRICT);
ini_set('memory_limit', -1);

// Import the HCMS_Contents class
require_once __DIR__ . '/../helpers/contents.php';

function register_routes()
{
    //print_r('Registering routes in requiem API');

    // register_rest_route('rest/v1', 'registration', array(
    //     'methods' => WP_REST_Server::CREATABLE,
    //     'callback' => array('HCMS_Satoloc_User_Auth', 'user_registration')
    // ));

    // register_rest_route('rest/v1', 'login', array(
    //     'methods' => WP_REST_Server::CREATABLE,
    //     'callback' => array('HCMS_Satoloc_User_Auth', 'user_login')
    // ));

    // register_rest_route('rest/v1', 'get-user-data', array(
    //     'methods' => WP_REST_Server::READABLE,
    //     'callback' => array('HCMS_Satoloc_User_Auth', 'get_user_data'),
    //     'permission_callback' => array('HCMS_Satoloc_User_Auth', 'is_user_authenticated')
    // ));

    // register_rest_route('rest/v1', 'update-profile', array(
    //     'methods' => WP_REST_Server::EDITABLE,
    //     'callback' => array('HCMS_Satoloc_User_Auth', 'update_user_profile'),
    //     'permission_callback' => array('HCMS_Satoloc_User_Auth', 'is_user_authenticated')
    // ));

    


    error_log('Routes registered successfully');
}

add_action('rest_api_init', 'register_routes');

// Function to handle contact form submissions
// function handle_contact_form($request)
// {
//     $params = $request->get_params();

//     // Validate the data
//     if (empty($params['name']) || empty($params['email']) || empty($params['message'])) {
//         return new WP_Error('missing_data', 'Please provide all required fields', array('status' => 400));
//     }

//     // Sanitize the data
//     $name = sanitize_text_field($params['name']);
//     $email = sanitize_email($params['email']);
//     $message = sanitize_textarea_field($params['message']);

//     // Create a new post of type 'contact_message'
//     $post_id = wp_insert_post(array(
//         'post_title' => 'Contact from ' . $name,
//         'post_content' => $message,
//         'post_type' => 'contact_message',
//         'post_status' => 'private',
//     ));

//     if (is_wp_error($post_id)) {
//         return new WP_Error('insert_failed', 'Failed to save the message', array('status' => 500));
//     }

//     // Add email as post meta
//     update_post_meta($post_id, 'contact_email', $email);

//     // Optionally, send an email notification
//     $to = get_option('admin_email');
//     $subject = 'New Contact Form Submission';
//     $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
//     wp_mail($to, $subject, $body);

//     return new WP_REST_Response(array('message' => 'Contact message received'), 200);
// }