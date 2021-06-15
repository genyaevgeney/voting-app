<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Category list.
     *
     * @var array
     */
    protected $categories = [
        'Electronics',
        'Appliances',
        'Instruments',
        'Furniture',
        'Plumbing',
        'Sport',
        'Stationery',
        'Other'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }
    }
}
