<?php

return [
    'ticket' => [
        'navigation_label' => 'Tickets',
        'model_label' => 'Ticket',
        'plural_model_label' => 'Tickets',

        'sections' => [
            'basic_info' => 'Información del Ticket',
            'status_info' => 'Estado y Prioridad',
        ],

        'fields' => [
            'subject' => 'Asunto',
            'description' => 'Descripción',
            'department' => 'Departamento',
            'status' => 'Estado',
            'priority' => 'Prioridad',
            'risk_level' => 'Nivel de Riesgo',
            'deadline' => 'Fecha Límite',
            'created_at' => 'Creado el',
        ],
    ],

    'department' => [
        'navigation_label' => 'Departamentos',
        'model_label' => 'Departamento',
        'plural_model_label' => 'Departamentos',

        'sections' => [
            'basic_info' => 'Información del Departamento',
        ],

        'fields' => [
            'name' => 'Nombre',
            'description' => 'Descripción',
            'active' => 'Activo',
            'tickets_count' => 'Tickets',
            'created_at' => 'Creado el',
        ],
    ],
];
