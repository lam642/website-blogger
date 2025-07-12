<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DanhMucSheeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 10; $i++) {
            Category::create([
                'name' => 'Danh mục ' . $i,
                'slug' => 'danh-muc-' . $i,
                'status' => 'active',
            ]);
        }
    }
}
