<?php

return [
    'seed' => [
        /*Начальные данные для пользователя*/
        'UserSeeder' => [
            'surname' => 'Кононов',
            'name' => 'Андрей',
            'patronymic' => 'Николаевич',
            'email' => 'user@example.com',
            'password' => '123123123',
            'role' => 'admin',
        ],
        /*Начальные данные для категорий расходов*/
        'ExtenceCategorySeeder' => [
            [
                'title' => 'Бензин',
                'user_id' => 1,
            ],
            [
                'title' => 'Штрафы',
                'user_id' => 1,
            ],
        ],
        /*Начальные данные для марок авто*/
        'MarkSeeder' => [
            [
                'title' => 'toyota'
            ],
            [
                'title' => 'mazda'
            ],
            [
                'title' => 'nissan'
            ],
            [
                'title' => 'mitsubishi'
            ],
        ],
        /*Начальные данные для моделей авто*/
        'PatternSeeder' => [
            [
                'title' => 'mark 2',
                'mark_id' => 1,
            ],
            [
                'title' => 'galant',
                'mark_id' => 4,
            ],
        ],
        /*Начальные данные для поколений авто*/
        'GenerationSeeder' => [
            [
                'title' => 'x100',
                'pattern_id' => 1,
            ],
            [
                'title' => '8',
                'pattern_id' => 2,
            ],
        ],
        /*Начальные данные для расходов на авто*/
        'ExtenceSeeder' => [
            [
                'title' => 'Оплатил бензин на 1000р 60л',
                'cost' => 1000,
                'category_id' => 1
            ],
        ],
        /*Начальные данные для авто пользователя*/
        'CarSeeder' => [
            [
                'title' => 'Бешенная табуретка',
                'user_id' => 1,
                'mark_id' => 1,
                'extence_id' => 1,
            ],
            [
                'title' => 'Бешенная табуретка2',
                'user_id' => 1,
                'mark_id' => 2,
                'extence_id' => 1,
            ],
        ],
    ],
];
