<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'database' => [
        'tables' => [
            'forms' => 'forms',
            'sections' => 'sections',
            'entries' => 'entries',
            'questions' => 'questions',
            'question_options' => 'question_options',
            'answers' => 'answers',
        ]
    ],
    'model' => class_exists(App\Models\User::class)? App\Models\User::class: App\User::class
];
