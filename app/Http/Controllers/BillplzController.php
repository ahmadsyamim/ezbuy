<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Buyforme;

class BillplzController extends Controller
{

    public function paycheck(Request $request, $signkey = 'S-ERrIvtf1G_Nx18O3yK82wg')
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
            // Todo: 
            // Check payment if $paid == true, check for billplz_id
            $product = Buyforme::where('billid',$data['id'])->first();
            $product->status = 2;
            $product->save();
            //paid_at
            //x_signature

            return redirect()->route('orderlist');
        } else {
            throw new \ErrorException('Data has been tempered');
        }
        // https://republicproxy.com/paycheck/?billplz%5Bid%5D=orbkffvq&billplz%5Bpaid%5D=true&billplz%5Bpaid_at%5D=2022-06-29+01%3A14%3A06+%2B0800&billplz%5Bx_signature%5D=8c5a4a02f2207f93d293d65fa09128e27ddf4515d5b543a234ad578463e62b24
        // reference : https://www.billplz.com/api#payment-completion-x-signature-redirect-url

    }

}
