<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'category_name'
    ];

    /**
     * Creates new category in DB.
     *
     * @param string $CategoryName
     * @param int $ParentId
     * @return Category
     */
    public static function createCategory(string $CategoryName, int $ParentId = null): Category
    {
        $Category = new self();
        $Category->category_name = $CategoryName;
        $Category->parent_id = $ParentId;
        $Category->save();

        return $Category;
    }

    /**
     * Checks if current category has children.
     *
     * @param string $CategoryId
     * @return bool
     */
    public static function isHaveChildren($CategoryId): bool
    {
        return self::where('parent_id', $CategoryId)->exists();
    }
}
