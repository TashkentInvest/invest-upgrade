<?php

return [
    'menu_top' => [
        'menu' => 'MENU',
        'api_users' => 'API Users'
    ],
    'userManagement' => [
        'title'          => 'Управление пользователями',
        'title_singular' => 'Управление',
    ],
    'permission'     => [
        'title'          => 'Управление разрешениями',
        'title_singular' => 'Разрешение',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Комментарий',
            'name'              => 'Название',
            'roles'             => 'Роли',
            'permissions'       => 'Разрешения',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'           => [
        'title'          => 'Управление ролями',
        'title_singular' => 'Роль',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'roles'             => 'Роли',
            'title'             => 'Комментарий',
            'name'              => 'Название',
            'title_helper'       => ' ',
            'permissions'        => 'Разрешение рола',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'           => [
        'title'          => 'Пользователи',
        'title_singular' => 'Пользователь',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Имя',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Пароль',
            'password_helper'          => ' ',
            'roles'                    => 'Роли',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],

    'client'           => [
        'title'          => 'Клиенты',
        'title_singular' => 'Клиент',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Имя',
            'first_name'                     => 'Имя',
            'last_name'                     => 'Фамилия',
            'father_name'                     => 'Отчество',
            'contact'                     => 'Контакт',
            'passport_serial'                     => 'Серия паспорта',
            'passport_pinfl'                     => 'Пинфл паспорта',
            'yuridik_address'                     => 'Юридический адрес',
            'yuridik_rekvizid'                     => 'Юридический реквизит',
            'mijoz_turi_yuridik'                     => 'Юридическое лицо',
            'mijoz_turi_fizik'                     => 'Физическое лицо',
            'passport_date'                     => 'паспорт_дата',
            'passport_location'                     => 'паспорт_местоположение',
            'mijoz_turi'                     => 'Тип человека',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Пароль',
            'password_helper'          => ' ',
            'roles'                    => 'Роли',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',

            
        ],
    ],
    'setting'        => [
        'title'          => 'Настройки',
        'about_company'  => 'О компании',
        'text_bot'       => 'Текст телеграмм-бота',
        'about'  => [
            'description' => 'О компании'
        ],
        'start_message' => [
            'title' => "Введение"
        ]
    ],
    'regions_districts' => [
        'title'          => 'Регионы и районы',
        'regions' => [
            'title' => 'Регионы',
            'name_uz' => 'Название на узбекском',
            'name_ru' => 'Название на русском'
        ],
        'districts' => [
            'title' => 'Районы',
            "select_region" => 'Выберите регион'
        ]
    ],
    'job'  => [
        'title' => 'Работа',
        'programs' => 'Программы',
        'fields' => [
            'name_uz' => 'Название на узбекском',
            'name_ru' => 'Название на русском'
        ]
    ],
    'branches' => [
        'title' => 'TEST',
        'fields' => [
            'name_uz' => 'Название на узбекском',
            'name_ru' => 'Название на русском',
            'description_uz' => "Описание на узбекском",
            'description_ru' => "Описание на русском",
            'photo' => "Фото",
            'longitude' => 'Долгота',
            'latitude' => 'Широта',
            'region_id' => 'Регион, в котором находится',
            'address' => "Адрес",
            'open_with_google_maps' => 'Открыть в Google Картах'
        ]
    ],

    'blogs' => [
        'title' => 'Новости',
        'fields' => [
            'name_uz' => 'Название на узбекском',
            'name_ru' => 'Название на русском',
            'description_uz' => "Описание на узбекском",
            'description_ru' => "Описание на русском",
            'photo' => "Фото",
            'address' => "Адрес",
            'open_with_google_maps' => 'Открыть в Google Картах'
        ]
    ],
    'category' => [
        'title' => 'Категории',
        'fields' => [
            'branch_id' => 'Офис',
            'name_uz' => 'Название на узбекском',
            'name_ru' => 'Название на русском',
            'parent_id'=>'Родительская категория',
            'address' => "Адрес"
        ]
        ],

    'company' => [
        'title' => 'Компания',
        'fields' => [
            'address' => "Адрес"
        ]
    ]
];
