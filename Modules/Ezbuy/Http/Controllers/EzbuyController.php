<?php

namespace Modules\Ezbuy\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ezbuy\Entities\Product;
use App\Models\Buyforme;
use Illuminate\Support\Facades\Auth;
use Validator;

class EzbuyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function refundupdate(Request $request)
    {
    
        $valarr = array(
            'bank' => 'required|not_in:0',
            'accno' => 'required|string|max:255',
            'receipname' => 'required|string|max:255',
                    );
    
        $validator = Validator::make($request->all(), $valarr);
    
        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>true]);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }
        
        dd($request->all());die;
        // $zoomapi = json_encode(array('keyone' => $request->keyone , 'keytwo' => $request->keytwo));
        // User::find($request->subadminid)->update(array('zoomapi'=>$zoomapi));
        // return redirect()->back()->with('success','設定されました。');
    
    }

    public function allorderlist()
    {
        die('allorderlist');
        $limit=10;
        $lists = Buyforme::where('user',auth()->user()->id)->orderByDesc('id')->paginate($limit);
        $ttlpage = (ceil($lists->total() / $limit));


        return view('ezbuy::orderlist',compact('lists','ttlpage'));
    }

     public function contactus()
    {
        return view('ezbuy::contactus');
    }

    //Store image
    public function storeImage(Request $request){

        if($request->file('image')){
            $file= $request->file('image');
            // $filename= date('YmdHi').$file->getClientOriginalName();
            $filename= $file->getClientOriginalName();
            $file-> move(public_path('images'), $filename);
        }
    
    }

    public function orderlist()
    {
        $limit=10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 

        $lists = Buyforme::whereIn('status',['2','3','7','8','9','11','12','13'])
                            ->where('user',auth()->user()->id)
                            ->where(function($query) use ($kword , $start , $end){
                                if (!empty($kword)) {
                                    $query->where('title','LIKE','%'.$kword.'%')
                                        ->orwhere('producturl','LIKE','%'.$kword.'%') 
                                        ;
                                }
                                if (!empty($start)) {
                                    $query->where('paid_at', '>',$start);
                                }
                                if (!empty($end)) {
                                    $query->where('paid_at', '<',$end);
                                }
                            })        
                            ->orderByDesc('id')->paginate($limit);
        $ttlpage = (ceil($lists->total() / $limit));


        return view('ezbuy::orderlist',compact('lists','ttlpage'));
    }

    public function watchlist()
    {   
        $limit=8;
        $lists = Buyforme::where('user',auth()->user()->id)->whereIn('status',[0,1])->orderByDesc('id')->paginate($limit);
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
        $data->user = auth()->user()->id;
        $data->save();

        $limit=4;
        $lists = Buyforme::where('user',auth()->user()->id)->whereIn('status',[0,1])->orderByDesc('id')->paginate($limit);
        $ttlpage = (ceil($lists->total() / $limit));

        return view('ezbuy::show', compact('data','lists','ttlpage'));
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
