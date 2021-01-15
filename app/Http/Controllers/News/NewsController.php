<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::where('is_published', 1)->paginate(4);

        return view('news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $item = new News($data);

        if(array_key_exists('published', $data) && $data['published'] === 'on') {
            $item->is_published = 1;
        } else {
            $item->is_published = 0;
        }

        if($request->hasFile('file')) {
            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'
            ]);

            $request->file->store('news', 'public');

            $item->image = $request->file()['file']->hashName();
        }

        $item->save();

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = News::findOrFail($id);

        $item->views += 1;
        $item->save();

        return view('news.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = News::findOrFail($id);


        return view('news.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $item = News::find($id);
        if(empty($item)) {
            return back()
                ->withErrors(['msg' => "News [{$id}] not found"])
                ->withInput();
        }

        $data = $request->all();

        if(array_key_exists('published', $data) && $data['published'] === 'on') {
            $item->is_published = 1;
        } else {
            $item->is_published = 0;
        }

        if($request->hasFile('file')) {
            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'
            ]);

            $request->file->store('news', 'public');

            $item->image = $request->file()['file']->hashName();
        }

        $item->fill($data)->save();


        return redirect()
            ->route('news.edit', $item->id)
            ->with(['success' => 'Successfully saved']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function orderByDate()
    {
        $news = News::orderBy('created_at', 'DESC')->paginate(4);

        return view('news.index', compact('news'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function orderByViews()
    {
        $news = News::orderBy('views', 'DESC')->paginate(4);

        return view('news.index', compact('news'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = News::find($id);
        $item->delete($id);

        return redirect('/home');
    }
}
