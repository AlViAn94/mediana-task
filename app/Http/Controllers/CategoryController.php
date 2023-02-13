<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('authenticated')
            ->only('store', 'destroy');
    }

    /**
     * Gets list of all categories as tree.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $Categories = Category::get()->toArray();
        $Categories = $this->buildTree($Categories);

        $Response['Response'] = [
            'Categories' => $Categories
        ];

        return response()->json($Response, 200);
    }

    /**
     * Builds tree from Categories array.
     *
     * @param $Elements
     * @param $ParentId
     * @return array
     */
    protected function buildTree($Elements, $ParentId = 0)
    {
        $Tree = array();

        foreach ($Elements as $Element) {
            if ($Element['parent_id'] == $ParentId) {
                $Children = $this->buildTree($Elements, $Element['id']);
                if ($Children) {
                    $Element['children'] = $Children;
                }
                $Tree[] = $Element;
            }
        }
        return $Tree;
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

        $Category = Category::createCategory($Data['category_name'], $Data['parent_id']);

        $Response['Response'] = [
            'Category' => $Category
        ];

        return response()->json($Response, 200);
    }

    /**
     * Show the specified resource.
     *
     * @param int $Id
     * @return JsonResponse
     */
    public function show(int $Id)
    {
        $Category = Category::findorfail($Id);

        $Response['Response'] = [
            'Category' => $Category
        ];

        return response()->json($Response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $Id
     * @return JsonResponse
     */
    public function destroy(int $Id)
    {
        $Category = Category::findorfail($Id);

        if(Category::isHaveChildren($Category->id)){
            abort(403, 'Category has children categories.');
        }
        $Category->delete();

        $Response['Response'] = [
            'Message' => 'Category was successfully deleted.'
        ];

        return response()->json($Response, 200);
    }
}
