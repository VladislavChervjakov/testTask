<?php

namespace App\Http\Controllers\Reviews;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Reviews::where('is_published', 1)->paginate(4);

        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reviews.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $data = $request->all();
        $item = new Reviews($data);
        $item->save();

        return redirect()->route('reviews.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Reviews::findOrFail($id);

        return view('reviews.edit', compact('item'));
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
        $item = Reviews::find($id);
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

        $item->fill($data)->save();


        return redirect()
            ->route('reviews.edit', $item->id)
            ->with(['success' => 'Successfully saved']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Reviews::find($id);
        $item->delete($id);

        return redirect('/home');
    }
}
