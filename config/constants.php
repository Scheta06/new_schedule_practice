<?php

return [
    'seed' => [
        /*Начальные данные для пользователя*/
        'UserSeeder'            => [
            'surname'    => 'кононов',
            'name'       => 'андрей',
            'patronymic' => 'николаевич',
            'email'      => 'user@example.com',
            'password'   => '123123123',
            'role'       => 'admin',
        ],
        /*Начальные данные для категорий расходов*/
        'ExtenceCategorySeeder' => [
            [
                'title'   => 'Бензин',
                'user_id' => 1,
                'car_id'  => 1,
            ],
            [
                'title'   => 'Штрафы',
                'user_id' => 1,
                'car_id'  => 1,
            ],
        ],
        /*Начальные данные для марок авто*/
        'MarkSeeder'            => [
            [
                'title' => 'toyota',
            ],
            [
                'title' => 'mitsubishi',
            ],
            [
                'title' => 'ВАЗ (LADA)',
            ],
        ],
        /*Начальные данные для моделей авто*/
        'PatternSeeder'         => [
            [
                'title'   => 'mark 2',
                'mark_id' => 1,
            ],
            [
                'title'   => 'carina ED',
                'mark_id' => 1,
            ],
            [
                'title'   => 'galant',
                'mark_id' => 2,
            ],
            [
                'title'   => 'legnum',
                'mark_id' => 2,
            ],
            [
                'title'   => '2113',
                'mark_id' => 3,
            ],
            [
                'title'   => 'priora',
                'mark_id' => 3,
            ],
        ],
        /*Начальные данные для поколений авто*/
        'GenerationSeeder'      => [
            [
                'title'      => 'x100',
                'pattern_id' => 1,
            ],
            [
                'title'      => 'x90',
                'pattern_id' => 1,
            ],
            [
                'title'      => 'T200',
                'pattern_id' => 2,
            ],
            [
                'title'      => '7',
                'pattern_id' => 3,
            ],
            [
                'title'      => '8',
                'pattern_id' => 3,
            ],
            [
                'title'      => 'VR4',
                'pattern_id' => 4,
            ],
            [
                'title'      => '1 samara',
                'pattern_id' => 5,
            ],
            [
                'title'      => '1 рестайлинг',
                'pattern_id' => 6,
            ],
        ],
        /*Начальные данные для расходов на авто*/
        'ExtenceSeeder'         => [
            [
                'title'       => 'Оплатил бензин на 1000р 60л',
                'cost'        => 1000,
                'category_id' => 1,
                'car_id'      => 1,
            ],
            [
                'title'       => 'Не успел заправиться',
                'cost'        => 1000,
                'category_id' => 1,
                'car_id'      => 1,
            ],
        ],
        /*Начальные данные для авто пользователя*/
        'CarSeeder'             => [
            [
                'title'         => 'Бешенная табуретка',
                'user_id'       => 1,
                'mark_id'       => 1,
                'pattern_id'    => 1,
                'generation_id' => 1,
            ],
            [
                'title'         => 'Бешенная табуретка2',
                'user_id'       => 1,
                'mark_id'       => 2,
                'pattern_id'    => 4,
                'generation_id' => 6,
            ],
        ],
    ],
];
