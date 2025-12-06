<?php

return [
    'ticket' => [
        'navigation_label' => 'Tickets',
        'model_label' => 'Ticket',
        'plural_model_label' => 'Tickets',

        'sections' => [
            'basic_info' => 'Ticket Information',
            'status_info' => 'Status & Priority',
        ],

        'fields' => [
            'subject' => 'Subject',
            'description' => 'Description',
            'department' => 'Department',
            'status' => 'Status',
            'priority' => 'Priority',
            'risk_level' => 'Risk Level',
            'deadline' => 'Deadline',
            'created_at' => 'Created At',
        ],
    ],

    'department' => [
        'navigation_label' => 'Departments',
        'model_label' => 'Department',
        'plural_model_label' => 'Departments',

        'sections' => [
            'basic_info' => 'Department Information',
        ],

        'fields' => [
            'name' => 'Name',
            'description' => 'Description',
            'active' => 'Active',
            'tickets_count' => 'Tickets',
            'created_at' => 'Created At',
        ],
    ],
];
