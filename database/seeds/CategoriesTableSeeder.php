<?php

use Illuminate\Database\Seeder;

use App\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $master = new Category();
		$master->name = 'Casa';
		$master->parent_id = 0;
		$master->save();

		$cat = new Category();
		$cat->name = 'Elettrodomestici';
		$cat->parent_id = $master->id;
		$cat->save();

		$cat = new Category();
		$cat->name = 'Utensili';
		$cat->parent_id = $master->id;
		$cat->save();

		$master = new Category();
		$master->name = 'Bambini';
		$master->parent_id = 0;
		$master->save();

		$cat = new Category();
		$cat->name = 'Giocattoli';
		$cat->parent_id = $master->id;
		$cat->save();

		$cat = new Category();
		$cat->name = 'Abbigliamento';
		$cat->parent_id = $master->id;
		$cat->save();

		$master = new Category();
		$master->name = 'Sport e Hobby';
		$master->parent_id = 0;
		$master->save();

		$cat = new Category();
		$cat->name = 'Biciclette';
		$cat->parent_id = $master->id;
		$cat->save();

		$cat = new Category();
		$cat->name = 'Animali';
		$cat->parent_id = $master->id;
		$cat->save();

		$cat = new Category();
		$cat->name = 'Intrattenimento';
		$cat->parent_id = $master->id;
		$cat->save();
    }
}
