<?php

return [

    'UPLOAD_PATH' => [
       'path' => public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR
    ],

    'VENDOR_UPDATE' => [
        'title' => 'Email or mobile number updated',
        'text' =>'has been updated password or mobile number.',
        'type' => 'document_update',
        'status' => 'unread'
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

    'CATEGORY_STATUS' => [
        'active' => 'Active',
        'inactive' => 'Inactive'
    ],

    'QUOTATION_DOCUMENT' => [
        'title' => 'Quotation Document',
        'text' =>'has been uploaded quotation',
        'type' => 'document_update',
        'status' => 'unread'
    ],

    'NOTIFICATION_STATUS' => [
        'read' => 'Read',
        'unread' => 'Unread'
    ],

];
