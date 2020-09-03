<?php

return [

    'UPLOAD_PATH' => [
       'path' => public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR
    ],

    'VENDOR_REGISTER' => [
        'title' => 'New Vendor Registered',
        'text' =>'has been updated password or mobile number.',
        'type' => 'vendor_register',
        'status' => 'unread'
    ],

    'VENDOR_UPDATE' => [
        'title' => 'Email or mobile number updated',
        'text' =>'has been updated password or mobile number.',
        'type' => 'vendor_update',
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
    
    'ADMIN_COMMENT'=>[
        'title' => 'Admin added comment',
        'text' =>'has been added comment',
        'type' => 'admin_comment',
        'status' => 'unread'
    ],

    'ADMIN_RATING_REVIEW'=>[
        'title' => 'Admin added review and rating',
        'text' =>'has been added review and rating.',
        'type' => 'new_review_rating',
        'status' => 'unread'
    ],
    'DOCUMENT_REASON'=>[
        'title' => 'Admin added reason',
        'text' =>'has been added reason for document.Please check your document.',
        'type' => 'document_reason',
        'status' => 'unread'
    ],

    'DOCUMENT_STATUS'=>[
        'title' => 'Document status updated',
        'text' =>'has been updated document status.',
        'type' => 'document_status_update',
        'status' => 'unread'
    ],

    'VENDOR_DOCUMENT_UPDATE'=>[
        'title' => 'Document updated',
        'text' =>'has been uploaded document.',
        'type' => 'vendor_update',
        'status' => 'unread'
    ]
];
