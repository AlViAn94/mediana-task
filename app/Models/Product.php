<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'product_name',
        'category_id',
        'product_price',
        'product_description'
    ];

    /**
     * Creates new product in DB.
     *
     * @param string $ProductName
     * @param int $CategoryId
     * @param int $ProductPrice
     * @param string $ProductDescription
     * @return Product
     */
    public static function createProduct(
        string $ProductName, int $CategoryId, int $ProductPrice, string $ProductDescription
    ): Product
    {
        $Product = new self();
        $Product->slug = uniqid();
        $Product->product_name = $ProductName;
        $Product->category_id = $CategoryId;
        $Product->product_price = $ProductPrice;
        $Product->product_description = $ProductDescription;
        $Product->save();

        return $Product;
    }

    /**
     * Get filtered products.
     *
     * @return Product
     */
    public function getProducts()
    {
        return $this->leftJoin('categories', 'categories.id', 'products.category_id')
            ->select(
                'products.id', 'products.slug', 'products.product_name', 'products.category_id', 'products.product_price',
                'products.product_description', 'categories.category_name'
            )
            ->groupBy('products.id')
            ->get();
    }
}
