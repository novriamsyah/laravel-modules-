<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Blogs;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index_blog()
    {
        $datas = Blogs::all();

        return datatables()->of($datas)->addColumn('action', 'blogs.buttons')
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }

}
