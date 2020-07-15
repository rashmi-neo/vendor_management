<?php

return [

    'UPLOAD_PATH' => [
       'path' => public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR
    ],

    'NOTIFICATION_TITLE' => [
        'title' => 'Email or mobile number updated '
    ],


    'VERIFICATION_STATUS' => [
        'approved' => 'Approved',
        'pending' => 'Pending',
        'rejected' => 'Rejected'
    ],

    'NEW_REQUIREMENT' => [
        'title' => 'New Requirement',
        'text' =>'New requirement assign from',
        'type' => 'new_requirement',
        'status' => 'unread'
     ],
];
