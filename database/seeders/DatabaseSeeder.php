<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $User = new User();
        $User->name = 'Admin';
        $User->email = 'admin@mail.com';
        $User->password = Hash::make('1234');
        $User->save();

        $Category1 = Category::createCategory('Men');
        $Category2 = Category::createCategory('Women');
        $Category3 = Category::createCategory('Unisex');

        $Category11 = Category::createCategory('Shoes', $Category1->id);
        $Category12 = Category::createCategory('Trousers', $Category1->id);
        $Category13 = Category::createCategory('Jackets', $Category1->id);

        $Category21 = Category::createCategory('Hats', $Category2->id);
        $Category22 = Category::createCategory('Skirts', $Category2->id);
        $Category23 = Category::createCategory('Bags', $Category2->id);

        $Category111 = Category::createCategory('Summer Shoes', $Category11->id);
        $Category112 = Category::createCategory('Demi-season Shoes', $Category11->id);
        $Category113 = Category::createCategory('Winter Shoes', $Category11->id);
        $Category121 = Category::createCategory('Tapered Trousers', $Category12->id);
        $Category122 = Category::createCategory('Loose Trousers', $Category12->id);
        $Category132 = Category::createCategory('Heavy Jackets', $Category13->id);

        $Category211 = Category::createCategory('Travellers Hats', $Category21->id);
        $Category212 = Category::createCategory('Natural Skin Hats', $Category21->id);
        $Category221 = Category::createCategory('Long Skirts', $Category22->id);
        $Category222 = Category::createCategory('Short Skirts', $Category22->id);
        $Category231 = Category::createCategory('Big Bags', $Category23->id);
        $Category232 = Category::createCategory('Medium Bags', $Category23->id);
        $Category233 = Category::createCategory('Small Bags', $Category23->id);

        //Trousers
        Product::createProduct(
            'Decathlon Quechua SH100', $Category12->id, 22000,
            'Universal trousers'
        );
        Product::createProduct(
            'AL-HAKIM 2000 khaki', $Category12->id, 14000,
            'Regular trousers'
        );

        //Tapered Trousers
        Product::createProduct(
            'Decathlon QUECHUA NH100', $Category121->id, 10000,
            'Regular trousers'
        );
        Product::createProduct(
            'Nike Tech Fleece CU4495', $Category121->id, 10000,
            'Regular trousers'
        );
        Product::createProduct(
            'Decathlon DOMYOS CU11234', $Category121->id, 19000,
            'Regular trousers'
        );

        //Loose Trousers
        Product::createProduct(
            'Alamata ExtraWarmLeggings', $Category122->id, 19000,
            'Regular trousers'
        );
        Product::createProduct(
            'Леггинсы Fashion 9801', $Category122->id, 19000,
            'Regular trousers'
        );

        //Shoes
        Product::createProduct(
            'Decathlon QUECHUA SH100 X', $Category11->id, 19000,
            'Regular shoes'
        );
        Product::createProduct(
            'Decathlon Quechua SH100 Warm', $Category11->id, 17000,
            'Regular shoes'
        );

        //Summer Shoes
        Product::createProduct(
            'Decathlon QUECHUA 8367614', $Category111->id, 9000,
            'Regular shoes'
        );
        Product::createProduct(
            'Alessio Nesca M8201992', $Category111->id, 9000,
            'Regular shoes'
        );

        //Demi-season Shoes
        Product::createProduct(
            'T.TACCARDI 25707010', $Category112->id, 34000,
            'Regular shoes'
        );
        Product::createProduct(
            'Alessio Nesca M8201994', $Category112->id, 34000,
            'Regular shoes'
        );

        //Winter Shoes
        Product::createProduct(
            'GBR A90-3W черный', $Category113->id, 40000,
            'Regular shoes'
        );
        Product::createProduct(
            'Adidas Hoops 2.0 Mid', $Category113->id, 40000,
            'Regular shoes'
        );
        Product::createProduct(
            'Boot', $Category113->id, 40000,
            'Regular shoes'
        );

        //Hats
        Product::createProduct(
            'Шапка женская 202040', $Category21->id, 5000,
            'Regular hat'
        );
        Product::createProduct(
            'Tactical шапка 07862', $Category21->id, 7000,
            'Regular hat'
        );

        //Travellers Hats
        Product::createProduct(
            'VIVAGOODS Пикачу', $Category211->id, 7500,
            'Regular hat'
        );
        Product::createProduct(
            'VIVAGOODS маска-шапка', $Category211->id, 7500,
            'Regular hat'
        );

        //Natural Skin Hats
        Product::createProduct(
            'Decathlon шапка 2130173', $Category212->id, 12000,
            'Regular hat'
        );
        Product::createProduct(
            'Балаклава MU-0529', $Category212->id, 10000,
            'Regular hat'
        );
        Product::createProduct(
            'MS балаклава M&G', $Category212->id, 13000,
            'Regular hat'
        );


        //Skirts
        Product::createProduct(
            'IN STYLE 1212', $Category22->id, 15000,
            'Regular skirt'
        );
        Product::createProduct(
            'THE BEST WISH BG9102256', $Category22->id, 14000,
            'Regular skirt'
        );

        //Long Skirts
        Product::createProduct(
            'TUBA Tex 01342-3TTS черный', $Category221->id, 13000,
            'Regular skirt'
        );
        Product::createProduct(
            'Jazu Brand SB1175-2', $Category221->id, 15000,
            'Regular skirt'
        );

        //Short Skirts
        Product::createProduct(
            'Koton 3WKG70047AK992', $Category222->id, 9000,
            'Regular skirt'
        );
        Product::createProduct(
            'ELIS SK0220', $Category222->id, 21000,
            'Regular skirt'
        );
        Product::createProduct(
            'ELIS SK4477', $Category22->id, 13000,
            'Regular skirt'
        );
    }
}
