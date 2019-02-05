<?php
return array(
    'GET' => [
        'home' => [
            'index'=>'HomeController@indexAction',
        ],
        'employees' => 'EmploeeController@GetEmployeesListAction',
        'accesses' => [
            'list'=>'AccessController@GetAccessesListAction',
            'update_page'=>'AccessController@UpdatePageAction',
            ],
    ],
    'POST' => [
        'accesses' => [
            'add_access'=>'AccessController@AddAccessAction',
            'delete_access'=>'AccessController@DeleteAccessAction',
            'update_access'=>'AccessController@UpdateAccessAction',
        ],

    ],
    'DELETE' => [
        'accesses' => [
            'delete_access'=>'AccessController@DeleteAccessAction',
        ],
    ],
    'put' => [
        '/author/(\d+)' => 'AuthorController@updateAuthorAction',
    ]

);