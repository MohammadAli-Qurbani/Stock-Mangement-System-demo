<?php

namespace App\Services\Category;

use App\Helper\UploadHelper;
use App\Models\Category;
use App\Models\Good;
use Illuminate\Http\Response;

class CategoryServices
{
    public function index()
    {
        return Category::latest('id')->get();
    }

    public function store(array $data): object
    {
        if ($data['image']) {
            $imagePath =  (new UploadHelper($data['image'], 'upload/category/images'))
                ->imageUploadHelper();
            $data['image'] = $imagePath;
        }
        return Category::create($data);
    }

    public function update(array $data, object $category)
    {
        if (array_key_exists('image',$data)) {
            $imagePath =  (new UploadHelper($data['image'], 'upload/category/images'))
                ->imageUploadHelper();
            $data['image'] = $imagePath;
            unlink($category->image);
        }
        return $category->update($data);

    }

    public function delete(object $category)
    {
        $good = Good::whereIn('category_id', [$category->id])->first();
        if ($good !== null) {
            return response("you can't delete this good category ", Response::HTTP_FORBIDDEN);
        }

        return $category->delete();
    }
}
