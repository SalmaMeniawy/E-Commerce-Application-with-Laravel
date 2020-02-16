<?php

use Illuminate\Database\Seeder;

class BuyerCategoriesTableSeeder extends Seeder
{
    protected $available_buyer_category_names = ['Gold','Silver','Bronz','normal'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       foreach($this->available_buyer_category_names as $item){
        DB::table('buyer_categories')->insert([
            'buyer_category_name'=>$item,
        ]);
       }
       
    }
}
