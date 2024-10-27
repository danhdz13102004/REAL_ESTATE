<?php

namespace App\Http\Controllers\PaymentOnline;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateStatusOffer;
use App\Models\Listing;
use App\Models\Offer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ZaloPaymentController extends Controller
{
    public function index() {}

    public function store(Request $request)
    {
        $res = file_get_contents("http://localhost:4040/api/tunnels");
        $data = json_decode($res, true);
        $publicURL = $data["tunnels"][0]["public_url"];

        $items = [];
        $offer = Offer::create([
            'listing_id' => $request->input('listing_id'),
            'user_id' => Auth::user()->id,
            'amount' => $request->input('amount'),
            'payment_status' => 3
        ]);



        $embeddata = json_encode([
            'redirecturl' => "$publicURL",
            'offer_id' => $offer->id
        ]);
        $itemsString = json_encode($items);
        $transID = rand(0, 1000000); //Random trans id
        $order = [
            "app_id" => config('payment.zalopay.id'),
            "app_time" => round(microtime(true) * 1000), // miliseconds
            "app_trans_id" => date("ymd") . "_" . $transID,
            "app_user" => "user123",
            "item" => $itemsString,
            "embed_data" => $embeddata,
            "amount" => $request->input('amount'),
            "description" => "Make offer with ID #$transID",
            "bank_code" => "",
            "callback_url" => $publicURL . "/api/zalopayment/callback"
        ];
        // dd($order);
        Log::info('order', ['order' => $order['app_trans_id']]);
        UpdateStatusOffer::dispatch($offer->id,$order['app_trans_id'])->delay(now()->addMinutes(15));
        // appid|app_trans_id|appuser|amount|apptime|embeddata|item
        $data = $order["app_id"] . "|" . $order["app_trans_id"] . "|" . $order["app_user"] . "|" . $order["amount"] . "|" . $order["app_time"] . "|" . $order["embed_data"] . "|" . $order["item"];

        $order["mac"] = hash_hmac("sha256", $data, config('payment.zalopay.key1'));

        $context = stream_context_create([
            "http" => [
                "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                "method" => "POST",
                "content" => http_build_query($order)
            ]
        ]);
        $resp = file_get_contents(config('payment.zalopay.ENDPOINT'), false, $context);
        $result = json_decode($resp, true);
        if ($result["return_code"] == 1) {
            return Inertia::location($result['order_url']);
        } else {
            dd($result);
        }
    }

  

    public function callback(Request $request)
    {
        $result = [];
        Log::info($request->all());
        try {
            
            // Get the raw POST data
            $postdata = $request->getContent();
            $postdatajson = json_decode($postdata, true);
            
            // Generate MAC using hash_hmac
            $mac = hash_hmac("sha256", $postdatajson['data'], config('payment.zalopay.key2'));
            $requestmac = $postdatajson['mac'];

            if($mac === $requestmac) {
                $datajson = json_decode($postdatajson['data'], true);
                Log::info($datajson);
                $embed_data = json_decode($datajson['embed_data'], true);
                $offer_id = $embed_data['offer_id'];
                $offer = Offer::find($offer_id);
                $offer->payment_status = 1;
                $offer->save();
            }


        } catch (Exception $e) {
            // Error handling
            $result['return_code'] = 0; // ZaloPay server will retry (up to 3 times)
            $result['return_message'] = $e->getMessage();
        }

        return response()->json($result);
    }

    public function status(Request $request)
    {

          
          $app_trans_id = $request->input('id');  // Input your app_trans_id
          $data = config('payment.zalopay.id') ."|".$app_trans_id."|". config('payment.zalopay.key1'); // app_id|app_trans_id|key1
          $params = [
            "app_id" => config('payment.zalopay.id'),
            "app_trans_id" => $app_trans_id,
            "mac" => hash_hmac("sha256", $data, config('payment.zalopay.key1'))
          ];
          
          $context = stream_context_create([
              "http" => [
                  "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                  "method" => "POST",
                  "content" => http_build_query($params)
              ]
          ]);
          
          $resp = file_get_contents(config('payment.zalopay.ENDPOINT_STATUS'), false, $context);
          $result = json_decode($resp, true);
          
          dd($result);
    }



}
