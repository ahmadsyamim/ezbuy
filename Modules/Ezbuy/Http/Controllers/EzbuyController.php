<?php

namespace Modules\Ezbuy\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ezbuy\Entities\Product;
use App\Models\Buyforme;
use Illuminate\Support\Facades\Auth;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendEmail;
use App\Models\User;

class EzbuyController extends Controller

{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function manualupdate(Request $request)
    {
    
        $valarr = array(
            'shippingfee' => 'required|integer|max:10255',
            'servicefee' => 'required|integer|max:10255',
                    );
    
        $validator = Validator::make($request->all(), $valarr);
    
        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>true]);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }
        
        Buyforme::where('id',$request->buyid)
        ->update([
            'status' => 1 ,
            'shippingfee' => $request->shippingfee ,
            'servicefee' => $request->servicefee ,
        ]);
        
        return Redirect('/manualorderlist')->with('success',"Order Updated.");
        // dd($request->all());die;
    }

    public function manualorderlist()
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

        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = '';
        } 

        $lists = Buyforme::where('user','<>',0)
                            ->where('shippingfee',0)
                            ->whereIn('status',['5','1'])
                            ->where(function($query) use ($kword , $start , $end , $id){
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
                                if (!empty($id)) {
                                    $query->where('id', $id);
                                }
                            })        
                            ->orderByDesc('id')->paginate($limit);
        $ttlpage = (ceil($lists->total() / $limit));

        return view('ezbuy::manualorderlist',compact('lists','ttlpage'));
    }

     
    public function updatestatus(Request $request)
    {
        $nextstatus = array(
                    '3' => '7',
                    '7' => '8',
                    '8' => '9',
                    );
        
        $data = Buyforme::find($request->buyid);
        if (!$data) { return Redirect::back()->with('error',"order not found"); }
        $data->status = $nextstatus[$data->status];
        $msg = "Status updated to [".$nextstatus[$data->status]."]";
        $data->save();

        return Redirect::back()->with('success',$msg);
        // dd($request->all());die;
    }

    public function contactsubmit(Request $request)
    {
    
        $valarr = array(
            'subject' => 'required|not_in:0',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string',
            'attachement' => 'max:3000',
                    );
    
        $validator = Validator::make($request->all(), $valarr);
    
        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>true]);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }
        // dd($request->all());die;
        if($request->file('attachement')){
            $file= $request->file('attachement');
            $filename= date('YmdHisv').$file->getClientOriginalName();
            $file-> move(public_path('attachements'), $filename);

            $attachhtml = '<a href="'.asset('attachements/'.$filename).'" target="_blank">'.$filename.'</a>';
        }

    	$user = User::first();
        
        $data = [
            'subject' => 'New Contact-Us Inquiry ['.config('global.contactsubject')[$request->subject].']',
            'greeting' => 'Hi '.$user->name.',',
            'body' => 'From : '.$request->name.' <br>Email : '.$request->email.'<br> Phone: '.($request->phone_number??'').'<br>Attachement: '.($attachhtml??'').'<br><br>Message :<br>'.$request->message.'<br><br>IP-address : '.($request->ipaddress ?? 'null').'<br>IP-agent : '.($request->agent ?? 'null'),
            'thanks' => "SILA BALAS JIKA PENTING",
            'actionText' => 'Reply',
            'actionURL' => url("mailto: ".$request->email),
        ];
        
        Notification::send($user, new SendEmail($data));
        return Redirect::back()->with('success',"Message Submitted.</br>Please allow 2 business days for response.");
    }

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
        
        Buyforme::where('id',$request->buyid)
        ->update([
            'status' => 12 ,
            'refundbank' => $request->bank ,
            'refundaccno' => $request->accno ,
            'refundreceipname' => $request->receipname ,
        ]);
        
    	$user = User::first();
  
        $data = [
            'subject' => 'A New Refund Request #'.$request->buyid,
            'greeting' => 'Hi '.$user->name.',',
            'body' => 'New Refund Request.',
            'thanks' => 'REFUND JE LA CEPAT SIKIT',
            'actionText' => 'Review',
            'actionURL' => url('/allorderlist?id='.$request->buyid),
        ];
  
        Notification::send($user, new SendEmail($data));
        return Redirect::back()->with('success',"Refund Request Submitted.</br>Please allow 2 business days for refund.");
        // dd($request->all());die;
    }

    public function allorderlist()
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

        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = '';
        } 

        $lists = Buyforme::whereIn('status',['2','3','7','8','9','11','12','13'])
                            ->where(function($query) use ($kword , $start , $end , $id){
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
                                if (!empty($id)) {
                                    $query->where('id', $id);
                                }
                            })        
                            ->orderByDesc('id')->paginate($limit);
        $ttlpage = (ceil($lists->total() / $limit));

        return view('ezbuy::allorderlist',compact('lists','ttlpage'));
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
        $lists = Buyforme::where('user',auth()->user()->id)->whereIn('status',[0,1,5])->orderByDesc('id')->paginate($limit);
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
