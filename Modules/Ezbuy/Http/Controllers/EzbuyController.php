<?php

namespace Modules\Ezbuy\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ezbuy\Entities\Product;
use App\Models\Buyforme;
use Illuminate\Support\Facades\Auth;

class EzbuyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function orderlist()
    {
        $limit=10;
        $lists = Buyforme::where('user',1)->whereIn('status',[0,1])->paginate($limit);
        $ttlpage = (ceil($lists->total() / $limit));


        return view('ezbuy::orderlist',compact('lists','ttlpage'));
    }

    public function watchlist()
    {   
        $limit=8;
        $lists = Buyforme::where('user',1)->whereIn('status',[0,1])->paginate($limit);
        $ttlpage = (ceil($lists->total() / $limit));

        return view('ezbuy::watchlist',compact('lists','ttlpage'));
    }

     public function index()
    {
        $data = Product::all();
        return view('ezbuy::index')->with('data',$data);
    }

    public function addSearch(Request $request)
    {
        $url = $request->get('url');
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            abort(500, 'Invalid URL.');
        }
        $product = Product::create([
            'producturl' => $url,
        ]);

        return response()->json($product);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ezbuy::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $data = Buyforme::find($id);
        if (!$data) { return redirect()->url('/'); }
        return view('ezbuy::show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('ezbuy::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
