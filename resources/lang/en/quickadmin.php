<?php

return [
	'create' => 'Create',
	'save' => 'Save',
	'edit' => 'Edit',
	'view' => 'View',
	'update' => 'Update',
	'list' => 'List',
	'no_entries_in_table' => 'No entries in table',
	'custom_controller_index' => 'Custom controller index.',
	'logout' => 'Logout',
	'add_new_mc' => 'Add new MC Question',
    'add_new_essay' => 'Add new Essay Question',
	'are_you_sure' => 'Are you sure?',
	'back_to_list' => 'Back to list',
	'dashboard' => 'Dashboard',
	'delete' => 'Delete',
	'quickadmin_title' => 'E-Exam',

	'user-management' => [
		'title' => 'User Management',
		'fields' => [
		],
	],

    'test' => [
        'new' => 'New Quiz',
    ],

	'roles' => [
		'title' => 'Roles',
		'fields' => [
			'title' => 'Title',
		],
	],

	'users' => [
		'title' => 'Users',
		'fields' => [
			'name' => 'Name',
			'email' => 'Email',
			'password' => 'Password',
			'role' => 'Role',
			'remember-token' => 'Remember token',
		],
	],

	'user-actions' => [
		'title' => 'User actions',
		'fields' => [
			'user' => 'User',
			'action' => 'Action',
			'action-model' => 'Action model',
			'action-id' => 'Action id',
		],
	],

	'topics' => [
		'title' => 'Subjects',
		'fields' => [
			'title' => 'Title',
		],
	],

	'questions' => [
		'title' => 'Questions',
        'add-new-MC' => 'Add MC Question',
        'add-new-essay' => 'Add Essay Question',
		'fields' => [
			'topic' => 'Topic',
			'question-text' => 'Question text',
			'code-snippet' => 'Code snippet',
			'answer-explanation' => 'Answer explanation',
			'more-info-link' => 'More info link'
		],
	],

	'questions-options' => [
		'title' => 'Questions Options',
		'fields' => [
			'question' => 'question',
			'option' => 'Option',
			'correct' => 'Correct',
		],
	],

	'results' => [
		'title' => 'My Result',
		'fields' => [
			'user' => 'User',
			'question' => 'Question',
			'correct' => 'Correct',
			'date' => 'Date',
			'result' => 'Score',
		],
	],

	'laravel-quiz' => 'New Quiz',
	'quiz' => 'Answer the Questions Below.',
	'submit_quiz' => 'Submit answers',
	'view-result' => 'View result',

];
