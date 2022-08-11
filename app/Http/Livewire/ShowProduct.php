<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Buyforme;

class ShowProduct extends Component
{
    public $data = null;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        return view('livewire.show-product', [
            'data' => $this->data,
        ]);
    }

    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function createbill($email = "ulhakim@gmail.com", $mobile = "+60143654005", $name = "apek", $amount = "100", $link = "www.yahoo.com") // remove default value later
    {
        $user = auth()->user();
        $email = $user->email;
        $name = $user->name;
        // $mobile = $user->phone_number;  // validate phone number as Google libphonenumber library first  //https://www.billplz.com/api#v3-bills-create-a-bill
        $link = $this->data->producturl ?? route('ezbuy.item', ['id' => $this->data->id]);
        //email => email customer
        //mobile =? no tel customer 
        //name => nama customer 
        //amount => nilai ( 100 =  RM1.00)
        //product link => link barang   
        $amount = ($this->data->sellprice * config('app.rate')) + $this->data->shippingfee + $this->data->servicefee;
        $amount = $amount*100;
        if(env('TEST_PAYMENT',false)) {
            $amount = env('TEST_PAYMENT_AMOUNT',200);
        }

        if ($this->data->paymentlink) {
            return redirect($this->data->paymentlink);
        }

        $url = "https://www.billplz.com/api/v3/bills";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Authorization: Basic ZTdjMDI5MmYtMjU2Yy00YjE3LWI2M2UtOWI4NjRiNTZlOGUyOg==",
            "Content-Type: application/x-www-form-urlencoded",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        // https://republicproxy.com/webhook/&redirect_url=https://republicproxy.com/paycheck/";
        // $data = "collection_id=osjbraql&description=Show Price is Total Price include Item Price , Shipping and Our Sevices Fee.&email=".$email."&mobile=".$mobile."&name=".$name."&amount=".$amount."&reference_1_label=Link&reference_1=".$link."&callback_url=".url('/webhook/&redirect_url='.url()->route('payment.paycheck'));
        $data = "collection_id=osjbraql&description=Show Price is Total Price include Item Price , Shipping and Our Sevices Fee.&email=".$email."&name=".$name."&amount=".$amount."&reference_1_label=Item&reference_1=".$link."&callback_url=".url('/webhook/&redirect_url='.url()->route('payment.paycheck'));

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        // var_dump($resp);die;
        // return redirect('/'.$resp);

        $resp = json_decode($resp);

        $billid = $resp->id;
        $paymentlink = $resp->url;
        
        //update 
        $Buyforme = Buyforme::find($this->data->id);
        $Buyforme->billid = $billid;
        $Buyforme->paymentlink = $paymentlink;
        $Buyforme->save();
        $this->data = $Buyforme;

        return redirect($paymentlink);
    }
}
