<?php

namespace Database\Seeders\Concerns;

use App\Category;
use App\Config;

trait CategoriesSeeder
{
    protected function saveConfigs($confs)
    {
        foreach($confs as $name => $value) {
            if (Config::where('name', $name)->first() == null) {
                $c = new Config();
                $c->value = $value;
                $c->name = $name;
                $c->save();
            }
        }
    }

    protected function populateDefaultCategories()
    {
        $this->populateCategories([
            'object' => [
                'Bambini' => (object) [
                    'children' => [
                        'Giocattoli',
                        'Abbigliamento',
                        'Attrezzatura',
                    ],
                ],
                'Casa' => (object) [
                    'children' => [
                        'Arredamento',
                        'Biancheria',
                        'Elettrodomestici',
                        'Elettronica',
                        'Stoviglie',
                        'Utensili',
                    ],
                ],
                'Abbigliamento' => (object) [
                    'children' => [
                        'Uomo',
                        'Donna',
                        'Scarpe',
                        'Accessori',
                    ],
                ],
                'Hobby' => (object) [
                    'children' => [
                        'Attrezzatura Sportiva',
                        'Biciclette',
                        'Altro',
                    ],
                ],
                'Attrezzatura Sanitaria' => (object) [
                ],
            ],
            'service' => [
                'Servizi' => (object) [
                ],

                'Affitti Casa' => (object) [
                    'direct_response' => true,
                ],
            ]
        ]);
    }

    protected function populateCategories($categories)
    {
        $managed = [];

        foreach($categories as $type => $contents) {
            foreach($contents as $primary => $meta) {
                $master = Category::where('name', $primary)->first();
                if (is_null($master)) {
                    $master = new Category();
            		$master->name = $primary;
            		$master->parent_id = 0;
                    $master->type = $type;
                    $master->direct_response = $meta->direct_response ?? false;
            		$master->save();
                }

                $managed[] = $primary;

                if (isset($meta->children)) {
                    foreach ($meta->children as $s) {
                        $cat = Category::where('name', $s)->first();
                        if (is_null($cat)) {
                            $cat = new Category();
                    		$cat->name = $s;
                        }

                		$cat->parent_id = $master->id;
                        $master->type = $type;
                		$cat->save();

                        $managed[] = $s;
                    }
                }
            }
        }

        Category::whereNotIn('name', $managed)->delete();
    }
}
