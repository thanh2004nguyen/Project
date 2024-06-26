<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

  



        DB::table('users')->insert([
        
                    [        'name' => 'user1',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 123   ],
                    [        'name' => 'user2',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user2@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 124    ],
                    [        'name' => 'user3',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user3@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,  'id' => 125   ],
                    [        'name' => 'user4',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user4@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 126    ],
                    [        'name' => 'user5',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user5@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 127    ],
                    [        'name' => 'user6',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user6@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,   'id' => 128 ],
                    [        'name' => 'user7',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user7@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 129    ],
                    [        'name' => 'user8',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user8@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,  'id' => 130   ],
                    [        'name' => 'user9',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user9@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,  'id' => 131   ],
                    [        'name' => 'user10',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user10@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 132    ],
                    [        'name' => 'user11',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user11@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 133    ],
                    [        'name' => 'user12',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user12@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 134    ],
                    [        'name' => 'user13',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user13@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 135    ],
                    [        'name' => 'user14',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user14@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 136    ],
                    [        'name' => 'user15',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user15@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 137    ],
                    [        'name' => 'user16',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user16@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 138    ],
                    [        'name' => 'user17',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user17@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 139    ],
                    [        'name' => 'user18',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user18@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,  'id' => 140   ],
                    [        'name' => 'user19',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user19@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,  'id' => 141   ],
                     [        'name' => 'user20',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user20@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 142    ],
                    [        'name' => 'user21',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user21@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 143    ],
                    [        'name' => 'user22',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user22@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,   'id' => 144  ],
                    [        'name' => 'user23',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user23@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 145    ],
                    [        'name' => 'user24',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user24@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,  'id' => 146   ],
                    [        'name' => 'user25',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user25@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,  'id' => 147  ],
                    [        'name' => 'user26',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user26@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,  'id' => 148   ],
                    [        'name' => 'user27',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user27@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,  'id' => 149   ],
                    [        'name' => 'user28',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user28@localhost.com',        'avatar' => 'dog',        'is_admin' => 0, 'id' => 150    ],
                    [        'name' => 'user29',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user29@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,   'id' => 151  ],
                    [        'name' => 'user30',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user30@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,   'id' => 152  ],
                    [        'name' => 'user31',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user31@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,   'id' => 153  ],
                    [        'name' => 'user32',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user32@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,  'id' => 154   ],
                    [        'name' => 'user33',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user33@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,   'id' => 155  ],
                    [        'name' => 'user34',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user34@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,  'id' => 156  ],
                    [        'name' => 'user35',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user35@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,  'id' => 157  ],
                    [        'name' => 'user36',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user36@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,  'id' => 158   ],
                    [        'name' => 'user37',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user37@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,  'id' => 159   ],
                    [        'name' => 'user38',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user38@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,  'id' => 160  ],
                    [        'name' => 'user39',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user39@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,   'id' => 161  ],
                    [        'name' => 'user40',        'password' => '$2y$10$TjxtH5phDlY33FdkvbrMGuhJAvcucYYFytrJWielfKdWfGQjr.rFe',        'email' => 'user40@localhost.com',        'avatar' => 'dog',        'is_admin' => 0,   'id' => 162  ],


                                                                                        
        ]);


        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make("123456"),
            'is_admin' => 1,
            'avatar' => 'dog',

        ]);

        \App\Models\User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make("123456"),
            'is_admin' => 0,
            'avatar' => 'bear'

        ]);



        DB::table('categories')->insert([
            ['name' => 'Inside House','category_id'=> 1	],
            ['name' => 'Bonsai In Garden','category_id'=> 2	],
            ['name' => 'Tet Tree','category_id'=> 3	],
            ['name' => 'Pots','category_id'=> 4	],
            ['name' => 'Pruning Tools','category_id'=> 5	],
            ['name' => 'Pots','category_id'=> 6	],
        ]);

        DB::table('providers')->insert([
            ['name' => 'GREEN HOUSE','provider_id'=> 1,'country' => 'VietNam','logo' => 'http://localhost:8000/productImages/cay-canh-nha-xanh.png'],
            ['name' => 'MINH HAO','provider_id'=> 2,'country' => 'VietNam','logo' => 'http://localhost:8000/productImages/cay-kieng-minh-thao.png'],
            ['name' => 'VIET LINH','provider_id'=> 3,'country' => 'VietNam','logo' => 'http://localhost:8000/productImages/viet-linh.png'],
            ['name' => 'VIET GARDEN','provider_id'=> 4,'country' => 'VietNam','logo' => 'http://localhost:8000/productImages/vuon-cay-viet.png'],
            ['name' => 'KN','provider_id'=> 5,'country' => 'VietNam','logo' => 'http://localhost:8000/productImages/xanh-bat-tan.png'],
            ['name' => 'KGF','provider_id'=> 6,'country' => 'VietNam','logo' => 'http://localhost:8000/productImages/dung-cu-cay-canh.png'],
        ]);

        
        DB::table('banners')->insert([
            ['bannername' => 'GREEN HOUSE','banerURL' => 'http://localhost:8000/productImages/baner4.png'],
            ['bannername' => 'GREEN HOUSE','banerURL' => 'http://localhost:8000/productImages/baner5.png'],
            ['bannername' => 'GREEN HOUSE','banerURL' => 'http://localhost:8000/productImages/baner6.png'],
            ['bannername' => 'GREEN HOUSE','banerURL' => 'http://localhost:8000/productImages/baner7.png'],
            ['bannername' => 'GREEN HOUSE','banerURL' => 'http://localhost:8000/productImages/baner8.png'],
       
           
        ]);


        DB::table('products')->insert([
            [
                'name' => 'HoneySuckle',
                'description' => 'Kim Ngan is known as one of the plants that bring good luck',
                'price' => 9,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 1,
                'category_id' => 1,
                'product_id' => 100009,
            ],

            [
                'name' => 'Snow Unicorn',
                'description' => 'Snow Unicorn is known as one of the plants that bring good luck',
                'price' => 12,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 2,
                'category_id' => 1,
                'product_id' => 100010,
            ],

            [
                'name' => 'Tiger Tongue Tree',
                'description' => 'Tiger Tongue Tree is known as one of the plants that bring good luck',
                'price' => 8,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 3,
                'category_id' => 1,
                'product_id' => 100011,
            ],

            [
                'name' => 'Phat Du',
                'description' => 'Phat Du is known as one of the plants that bring good luck',
                'price' => 9,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 2,
                'category_id' => 1,
                'product_id' => 100012,
            ],

            [
                'name' => 'Fortune Tree',
                'description' => 'Fortune Tree is known as one of the plants that bring good luck',
                'price' => 25,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 5,
                'category_id' => 1,
                'product_id' => 100013,
            ],

            [
                'name' => 'Magnolia Tree',
                'description' => 'Magnolia Tree is known as one of the plants that bring good luck',
                'price' => 40,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 3,
                'category_id' => 1,
                'product_id' => 100014,
            ],

            [
                'name' => 'Cactus',
                'description' => 'Cactus is known as one of the plants that bring good luck',
                'price' => 30,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 1,
                'category_id' => 1,
                'product_id' => 100015,
            ],

            [
                'name' => 'BamBoo',
                'description' => 'BamBoo is known as one of the plants that bring good luck',
                'price' => 60,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 5,
                'category_id' => 2,
                'product_id' => 100016,
            ],

            [
                'name' => 'Croton',
                'description' => 'Croton is known as one of the plants that bring good luck',
                'price' => 22,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 1,
                'category_id' => 2,
                'product_id' => 100017,
            ],

            [
                'name' => 'Sakura',
                'description' => 'Sakura is known as one of the plants that bring good luck',
                'price' => 77,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 5,
                'category_id' => 3,
                'product_id' => 100018,
            ],

            [
                'name' => 'Plum Tree',
                'description' => 'Plum Tree is known as one of the plants that bring good luck',
                'price' => 120,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 5,
                'category_id' => 3,
                'product_id' => 100019,
            ],

            [
                'name' => 'Ceramic Pots Pink',
                'description' => 'Ceramic Post is use to plant',
                'price' => 2,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 2,
                'category_id' => 4,
                'product_id' => 100020,
            ],

            [
                'name' => 'Plastic Pots White',
                'description' => 'Ceramic Post is use to plant',
                'price' => 3,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 1,
                'category_id' => 4,
                'product_id' => 100021,
            ],

            [
                'name' => 'Glass Pots',
                'description' => 'Glass Post is use to plant',
                'price' => 9,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 4,
                'category_id' => 4,
                'product_id' => 100022,
            ],

            [
                'name' => 'Secateurs',
                'description' => 'Secateurs is use to cut and design bonsai',
                'price' => 9,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 1,
                'category_id' => 5,
                'product_id' => 100023,
            ],

            [
                'name' => 'Mini Shovel',
                'description' => 'Mini Shovel is use in  garden',
                'price' => 9,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 6,
                'category_id' => 5,
                'product_id' => 100024,
            ],


            [
                'name' => 'Fertilizer',
                'description' => 'Fertilizer is use in  garden',
                'price' => 9,
                'quantity' => 99,
                'sales_count' => 0,
                'provider_id' => 6,
                'category_id' => 6,
                'product_id' => 100025,
            ],

        ]);



        DB::table('images')->insert([
            ['url' => 'http://localhost:8000/productImages/cay-kim-ngan1.jpg','product_id'=>'100009'],
            ['url' => 'http://localhost:8000/productImages/cay-kim-ngan2.jpg','product_id'=> '100009'],
            ['url' => 'http://localhost:8000/productImages/cay-kim-ngan3.jpg','product_id'=> '100009'],

            ['url' => 'http://localhost:8000/productImages/cay-lan-tuyet1.jpg','product_id'=> '100010'],
            ['url' => 'http://localhost:8000/productImages/cay-lan-tuyet2.jpg','product_id'=> '100010'],
            ['url' => 'http://localhost:8000/productImages/cay-lan-tuyet3.jpg','product_id'=> '100010'],

            ['url' => 'http://localhost:8000/productImages/cay-luoi-ho1.jpg','product_id'=> '100011'],
            ['url' => 'http://localhost:8000/productImages/cay-luoi-ho2.jpg','product_id'=> '100011'],
            ['url' => 'http://localhost:8000/productImages/cay-luoi-ho3.jpg','product_id'=> '100011'],
            ['url' => 'http://localhost:8000/productImages/cay-luoi-ho4.jpg','product_id'=> '100011'],

            ['url' => 'http://localhost:8000/productImages/cay-phất-du.jpg','product_id'=> '100012'],
            ['url' => 'http://localhost:8000/productImages/cay-phất-du1.jpg','product_id'=> '100012'],
            ['url' => 'http://localhost:8000/productImages/cay-phất-du2.jpg','product_id'=> '100012'],
            ['url' => 'http://localhost:8000/productImages/cay-phất-du3.jpg','product_id'=> '100012'],

            ['url' => 'http://localhost:8000/productImages/cay-tai-loc.jpg','product_id'=> '100013'],
            ['url' => 'http://localhost:8000/productImages/cay-tai-loc1.jpg','product_id'=> '100013'],
            ['url' => 'http://localhost:8000/productImages/cay-tai-loc-2','product_id'=> '100013'],
            ['url' => 'http://localhost:8000/productImages/cay-tai-loc-3.jpg','product_id'=> '100013'],

            ['url' => 'http://localhost:8000/productImages/cay-thiet-moc-lan.jpg','product_id'=> '100014'],
            ['url' => 'http://localhost:8000/productImages/cay-thiet-moc-lan-2.jpg','product_id'=> '100014'],
            ['url' => 'http://localhost:8000/productImages/thiet-moc-lan3.jpg','product_id'=> '100014'],

            ['url' => 'http://localhost:8000/productImages/cay-xuong-rong-hop-menh-gi-1.jpg','product_id'=> '100015'],
            ['url' => 'http://localhost:8000/productImages/co-gai-tang-xuong-rong-2.jpg','product_id'=> '100015'],
            ['url' => 'http://localhost:8000/productImages/dat-cay-xuong-rong-de-ban-1.jpg','product_id'=> '100015'],

            ['url' => 'http://localhost:8000/productImages/cay-truc-quan-tu-tuong-cay-gia-trang-tri.jpg','product_id'=> '100016'],
            ['url' => 'http://localhost:8000/productImages/cay-truc-quan-tu-tuong-cay-gia-trang-tri.jpg','product_id'=> '100016'],
            ['url' => 'http://localhost:8000/productImages/dac-diem-truc-quan-tu-dep.jpg','product_id'=> '100016'],

            ['url' => 'http://localhost:8000/productImages/Croton.jpg','product_id'=> '100017'],
            ['url' => 'http://localhost:8000/productImages/Croton2.jpg','product_id'=> '100017'],

            ['url' => 'http://localhost:8000/productImages/hoa-dao.png','product_id'=> '100018'],
            ['url' => 'http://localhost:8000/productImages/cay-hoa-dao.jpg','product_id'=> '100018'],
            ['url' => 'http://localhost:8000/productImages/cay-dao-ngay-tet-3.jpg','product_id'=> '100018'],

            ['url' => 'http://localhost:8000/productImages/cay-mai-ngay-tet-dep.jpg','product_id'=> '100019'],
            ['url' => 'http://localhost:8000/productImages/cay-mai-ngay-tet-dep1.jpg','product_id'=> '100019'],

            ['url' => 'http://localhost:8000/productImages/chau-gom-nhat-dia-to-hong.jpg','product_id'=> '100020'],
            ['url' => 'http://localhost:8000/productImages/chau-gom-nhat-dia-to-hong-tron.jpg','product_id'=> '100020'],

            ['url' => 'http://localhost:8000/productImages/chau-gom-nhat-dia-to-trang.jpg','product_id'=> '100020'],
            ['url' => 'http://localhost:8000/productImages/chau-gom-nhat-dia-to-vang.jpg','product_id'=> '100020'],

            ['url' => 'http://localhost:8000/productImages/chau-nhua1.jpg','product_id'=> '100021'],
            ['url' => 'http://localhost:8000/productImages/chau-nhua2.jpg','product_id'=> '100021'],
            ['url' => 'http://localhost:8000/productImages/chau-nhua3.jpg','product_id'=> '100021'],

            ['url' => 'http://localhost:8000/productImages/chau-thuy-tinh2.jpg','product_id'=> '100022'],
            ['url' => 'http://localhost:8000/productImages/chau-thuy-tinh4.jpg','product_id'=> '100022'],
            ['url' => 'http://localhost:8000/productImages/chau-thuy-tinh5.jpg','product_id'=> '100022'],

            ['url' => 'http://localhost:8000/productImages/keo-tia-cay-canh-nd1.jpg','product_id'=> '100023'],
            ['url' => 'http://localhost:8000/productImages/keo-cat-tia-cay-canh-4.jpg','product_id'=> '100023'],

            ['url' => 'http://localhost:8000/productImages/seng3.jpg','product_id'=> '100024'],
            ['url' => 'http://localhost:8000/productImages/seng-ngan.jpg','product_id'=> '100024'],

            ['url' => 'http://localhost:8000/productImages/phan-doi-so-1.jpg','product_id'=> '100025'],
            ['url' => 'http://localhost:8000/productImages/phan-doi-chi-tiet.jpg','product_id'=> '100025'],
            ['url' => 'http://localhost:8000/productImages/phan-bon3.jpg','product_id'=> '100025'],
            ['url' => 'http://localhost:8000/productImages/phan-bon2.jpg','product_id'=> '100025'],

        ]);










    }
}
