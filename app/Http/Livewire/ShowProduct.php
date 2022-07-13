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
        $mobile = $user->phone_number;
        $link = route('ezbuy.item', ['id' => $this->data->id]);
        //email => email customer
        //mobile =? no tel customer 
        //name => nama customer 
        //amount => nilai ( 100 =  RM1.00)
        //product link => link barang   
        $amount = $this->data->sellprice;

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

        $data = "collection_id=osjbraql&description=Show Price is Total Price include Item Price , Shipping and Our Sevices Fee.&email=".$email."&mobile=".$mobile."&name=".$name."&amount=".$amount."&reference_1_label=Link&reference_1=".$link."&callback_url=https://republicproxy.com/webhook/&redirect_url=https://republicproxy.com/paycheck/";

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        // var_dump($resp);

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

    public function paycheck($signkey = 'S-ERrIvtf1G_Nx18O3yK82wg')
    {


        if (empty($signkey)) {
            $signkey = self::$x_signature;
        }

        $data = array(
            'id' => isset($_GET['billplz']['id']) ? $_GET['billplz']['id'] : throw new \ErrorException('Billplz ID is not supplied'),
            'paid_at' => isset($_GET['billplz']['paid_at']) ? $_GET['billplz']['paid_at'] : throw new \ErrorException('Please enable Billplz XSignature Payment Completion'),
            'paid' => isset($_GET['billplz']['paid']) ? $_GET['billplz']['paid'] : throw new \ErrorException('Please enable Billplz XSignature Payment Completion'),
            'x_signature' => isset($_GET['billplz']['x_signature']) ? $_GET['billplz']['x_signature'] : throw new \ErrorException('Please enable Billplz XSignature Payment Completion'),
        );
        $preparedString = '';
        foreach ($data as $key => $value) {
            $preparedString .= 'billplz' . $key . $value;
            if ($key === 'paid') {
                break;
            } else {
                $preparedString .= '|';
            }
        }
        $generatedSHA = hash_hmac('sha256', $preparedString, $signkey);

        /*
         * Convert paid status to boolean
         */
        $data['paid'] = $data['paid'] === 'true' ? true : false;

        if ($data['x_signature'] === $generatedSHA) {
            return $data;
        } else {
            throw new \ErrorException('Data has been tempered');
        }
        // https://republicproxy.com/paycheck/?billplz%5Bid%5D=orbkffvq&billplz%5Bpaid%5D=true&billplz%5Bpaid_at%5D=2022-06-29+01%3A14%3A06+%2B0800&billplz%5Bx_signature%5D=8c5a4a02f2207f93d293d65fa09128e27ddf4515d5b543a234ad578463e62b24
        // reference : https://www.billplz.com/api#payment-completion-x-signature-redirect-url

    }
}
