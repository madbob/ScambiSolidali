<?php

use Illuminate\Database\Seeder;

use App\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Bambini' => [
                'Giocattoli',
                'Abbigliamento',
                'Attrezzatura'
            ],
            'Casa' => [
                'Arredamento',
                'Biancheria',
                'Elettrodomestici',
                'Elettronica',
                'Stoviglie',
                'Utensili'
            ],
            'Abbigliamento' => [
                'Uomo',
                'Donna',
                'Scarpe',
                'Accessori'
            ],
            'Hobby' => [
                'Attrezzatura Sportiva',
                'Biciclette',
                'Altro'
            ],
            'Attrezzatura Sanitaria' => [
            ]
        ];

        foreach($categories as $primary => $subs) {
            $master = new Category();
    		$master->name = $primary;
    		$master->parent_id = 0;
    		$master->save();

            foreach ($subs as $s) {
                $cat = new Category();
        		$cat->name = $s;
        		$cat->parent_id = $master->id;
        		$cat->save();
            }
        }
    }
}
