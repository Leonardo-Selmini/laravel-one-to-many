<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categories = ["Antipasti", "Primi", "Secondi", "Contorni", "Dolci", "Bevande", "Vini", "Drinks", "Amari", "Birre"];

      foreach($categories as $category){
        $newCategory = New Category;
        $newCategory->name = $category;
        $newCategory->slug = Str::of($newCategory->name)->slug("-");
        $newCategory->save();
      }
    }
}
