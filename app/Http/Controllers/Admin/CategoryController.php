
<?php

namespace App\Http\Controllers\Admin;

class CategoryController extends CommonController
{
    public function index()
    {
        return view('admin.cate.index');
    }
}
