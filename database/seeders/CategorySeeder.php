<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $categories = [
            ['name' => 'Alimentação',   'type' => 'expense', 'user_id' => null],
            ['name' => 'Transporte',    'type' => 'expense', 'user_id' => null],
            ['name' => 'Saúde',         'type' => 'expense', 'user_id' => null],
            ['name' => 'Lazer',         'type' => 'expense', 'user_id' => null],
            ['name' => 'Educação',      'type' => 'expense', 'user_id' => null],
            ['name' => 'Moradia',       'type' => 'expense', 'user_id' => null],
            ['name' => 'Vestuário',     'type' => 'expense', 'user_id' => null],
            ['name' => 'Outros',        'type' => 'expense', 'user_id' => null],
            ['name' => 'Salário',       'type' => 'income',  'user_id' => null],
            ['name' => 'Freelance',     'type' => 'income',  'user_id' => null],
            ['name' => 'Investimentos', 'type' => 'income',  'user_id' => null],
            ['name' => 'Outros',        'type' => 'income',  'user_id' => null],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
        
    }
}
