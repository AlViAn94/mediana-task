<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticated')
            ->only('store', 'destroy');
    }
    /**
     * Gets list of all products.
     *
     * @param Request $Request
     * @return JsonResponse
     */
    public function index(Request $Request)
    {
        $Product = (new Product())->getProducts($Request);

        $Response['Response'] = [
            'Products' => $Product
        ];

        return response()->json($Response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $Request
     * @return JsonResponse
     */
    public function store(Request $Request)
    {
        $Data = $Request['data'];

        $Product = Product::createProduct(
            $Data['product_name'], $Data['category_id'], $Data['product_price'], $Data['product_description']
        );

        $Response['Response'] = [
            'Product' => $Product
        ];

        return response()->json($Response, 200);
    }

    /**
     * Show the specified resource.
     *
     * @param string $Slug
     * @return JsonResponse
     */
    public function show(string $Slug)
    {
        $Product = Product::where('slug', $Slug)->firstOrFail();
        
        $Response['Response'] = [
            'Product' => $Product
        ];

        return response()->json($Response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $Slug
     * @return JsonResponse
     */
    public function destroy(string $Slug)
    {
        $Product = Product::where('slug', $Slug)->firstOrFail();
        $Product->delete();

        $Response['Response'] = [
            'Message' => 'Product was successfully deleted.'
        ];

        return response()->json($Response, 200);
    }
}
