<?php

namespace App\Jobs;

use App\Models\Offer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateStatusOffer implements ShouldQueue
{
    use Queueable;

    private $offer_id;
    private $transID;
    public function __construct($offer_id,$transID)
    {
        $this->offer_id = $offer_id;
        $this->transID = $transID;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $offer = Offer::find($this->offer_id);
        if($offer->payment_status == 3) {
            $app_trans_id = $this->transID; 
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
          Log::info("update");
          Log::info($result);
          $offer->payment_status = $result["return_code"];
          $offer->save();
        }
    }
}
