<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
// use Illuminate\Routing\Controller;

use Modules\Blog\Entities\Blogs;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $datas = Blogs::latest()->get();
        // dd($datas);
        return view('blog::index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('blog::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|string|max:155',
            'isi' => 'required',
            'penulis' => 'required'
        ]);

        $post = Blogs::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'penulis' => $request->penulis,
        ]);

        if ($post) {
            return redirect()
                ->route('blog.index')
                ->with([
                    'success' => 'New post Blog has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('blog::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $post = Blogs::findOrFail($id);
        return view('blog::edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required|string|max:155',
            'isi' => 'required',
            'penulis' => 'required'
        ]);

        $post = Blogs::findOrFail($id);

        $post->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'penulis' => $request->penulis,
        ]);

        if ($post) {
            return redirect()
                ->route('blog.index')
                ->with([
                    'success' => 'Blog has been updated successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem has occured, please try again'
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $post = Blogs::findOrFail($id);
        $post->delete();

        if ($post) {
            return redirect()
                ->route('blog.index')
                ->with([
                    'success' => 'Post has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('blog.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }
}
