<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'sessions' =>[
        'notcompleted' => 'You do not have sufficient permissions to create rating for session which is not completed!',
        'notscheduled' => 'This can only be done while session has scheduled status!'
    ],
    'questions' =>[
        'insufficient_permissions' => 'You do not have sufficient permissions on answer to this question!',
    ],
    'ratings' =>[
        'already_added' => "You can only add one rating per session!"
    ],

    'token_not_provided' => 'Token not provided!',
    'token_expired' => 'Token has been expired!',
    'token_invalid' => 'Invalid token!',
    'failed' => 'These credentials do not match our records.',
    'insufficient_permissions' => 'You do not have sufficient permissions to access this resource',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'confirm_email' => 'Please confirm your email!',
    'banned' => 'You have been banned by administrator. Please contact us to get this sorted out!',
    'deleted' => 'This account has been deleted!',
    'user_not_found' => 'User not found!',
    'invalid_access_token' => 'Invalid access token.',
    'facebook_not_connected' => 'You are still not connected with Facebook.',
    'invalid_code' => 'Invalid confirmation code.',
    'success_confirmation' => 'You have successfully confirmed your email. You can login now!',
    'success_registration' => 'You are successfully registred! Please confirm your email.',
    
];
