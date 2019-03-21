<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuotationFormRequest;
use App\Models\Quotation;

class CalculatorController extends Controller
{
    private $quotation;

    public function __construct(Quotation $quotation)
    {
        $this->quotation = $quotation;
    }

    public function index()
    {
        $last_quotations = $this->quotation->orderBy('id', 'desc')->take(5)->get();

        return view('calculator.calculator')->with(compact('last_quotations'));
    }

    public function result(QuotationFormRequest $request)
    {
        $dataForm = $request->except('_token');

        $dataForm['from_cep'] = preg_replace("/[.-]/", "", $dataForm['from_cep']);
        $dataForm['to_cep'] = preg_replace("/[.-]/", "", $dataForm['to_cep']);
        $dataForm['weight'] = str_replace(",", ".", $dataForm['weight']);
        $dataForm['value'] = isset($dataForm['value']) ? str_replace(',','.',str_replace('.','',$dataForm['value'])) : 0;
        $dataForm['ar'] = !isset($dataForm['ar']) ? 0 : 1;
        $dataForm['mp'] = !isset($dataForm['mp']) ? 0 : 1;

        $insert = $this->quotation->create($dataForm);

        if($insert)
        {

            $client = new \GuzzleHttp\Client();
            $response = $client->request(
                'POST',
                'https://www.melhorenvio.com.br/api/v2/me/shipment/calculate',
                [
                    'json' => [
                        'from' => [
                            "postal_code" => $dataForm['from_cep'],
                            "address" => '',
                            "number" => ''
                        ],
                        'to' => [
                            "postal_code" => $dataForm['to_cep'],
                            "address" => '',
                            "number" => ''
                        ],
                        'package' => [
                            "weight" => $dataForm['weight'],
                            "width" => $dataForm['width'],
                            "height" => $dataForm['height'],
                            "length" => $dataForm['length']
                        ],
                        'options' => [
                            "insurance_value" => $dataForm['value'],
                            "receipt" => $dataForm['ar'] == 1 ? true : false,
                            "own_hand" => $dataForm['mp'] == 1 ? true : false,
                            "collect" => false
                        ],
                        "services" => "1,2"
                    ],
                    'headers' => [
                        "accept" => "application/json",
                        "authorization" =>  "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImViYzU1ZWVmZmVkODdlMmRiMTNlZGQ3OTBhMjAzNjViMTUwZDM1MjE5N2I2OGVmNjVmYmYzNjhmNGNkODBhZTEwZDEyOTI4ZGJkYjVhMjA3In0.eyJhdWQiOiIxIiwianRpIjoiZWJjNTVlZWZmZWQ4N2UyZGIxM2VkZDc5MGEyMDM2NWIxNTBkMzUyMTk3YjY4ZWY2NWZiZjM2OGY0Y2Q4MGFlMTBkMTI5MjhkYmRiNWEyMDciLCJpYXQiOjE1NTMxODA1MTYsIm5iZiI6MTU1MzE4MDUxNiwiZXhwIjoxNTg0ODAyOTE2LCJzdWIiOiJlYjU4M2U3NC1lNWZmLTRlMTgtYjk0My05MmJlYzRiMGMzNTAiLCJzY29wZXMiOlsiY2FydC1yZWFkIiwiY2FydC13cml0ZSIsImNvbXBhbmllcy1yZWFkIiwiY29tcGFuaWVzLXdyaXRlIiwiY291cG9ucy1yZWFkIiwiY291cG9ucy13cml0ZSIsIm5vdGlmaWNhdGlvbnMtcmVhZCIsIm9yZGVycy1yZWFkIiwicHJvZHVjdHMtcmVhZCIsInByb2R1Y3RzLXdyaXRlIiwicHVyY2hhc2VzLXJlYWQiLCJzaGlwcGluZy1jYWxjdWxhdGUiLCJzaGlwcGluZy1jYW5jZWwiLCJzaGlwcGluZy1jaGVja291dCIsInNoaXBwaW5nLWNvbXBhbmllcyIsInNoaXBwaW5nLWdlbmVyYXRlIiwic2hpcHBpbmctcHJldmlldyIsInNoaXBwaW5nLXByaW50Iiwic2hpcHBpbmctc2hhcmUiLCJzaGlwcGluZy10cmFja2luZyIsImVjb21tZXJjZS1zaGlwcGluZyIsInRyYW5zYWN0aW9ucy1yZWFkIiwidXNlcnMtcmVhZCIsInVzZXJzLXdyaXRlIiwid2ViaG9va3MtcmVhZCIsIndlYmhvb2tzLXdyaXRlIl19.xsUh-G5jZDkCPnUlLyi0OhIKJ0zYPxahZ6--DWebHt33lzHchcIUIDzghPHgZmi6AuiuirBeB0CjnuyQVi_2yQo8kp4dhwcoI9wQAD5E1ebrSKtA3LoJJHFF3WHPh4XFlX1ekFfcToeaQACYKRp2qUsc-Xd2GazuCfBLwLAr4l3lYiEDc8rSgR-JRfIUUp1F9cnY1BQqR0W9yL9IkxiH2kBXQ6ldPtdTc4MiBLsKU5SA2Vyyz44bZ-XiP8FjMqoPnWgEj4uqjgweGsiCXThidCI6xPA2N-lFlOosZHTTMES4IvBoeB4QovhAcQv3nWCAl8esVr7Lkytd8Bpw5dZ98iB7qFxPvBxnXy5p16-Bq5uNv7LsZIHoy4VsTgY4tQW1_NoKnOGJLW3bhjd8BBzcbH9U9aoCKbovl2Ag9pITAFESKadxDdPSKxBRQXkObDhJJ4WYU5iWaZrdN5uDFEDpQAURGs9jiB-pm239GO4cKYUR6k5lwUqWuVdL-_S1Bmnq8q0XFftFDVLIWyNUCUL97RSWwLGzrO8gRzhvxR_ceIX9VSsSIxnH8E6l8ghGnEq4cGplwYt_wBkqNrP7PoTy_GWjnSfRk0nCngkKMtFRtN_6M6LQoEkCTO-t3rUdiZakNigJwPPEmvt2VYd6HdsbfzRS1A3gxYisbmPPqG-2mTI",
                        "content-type" => "application/json"
                    ]
                ]
            );

            $response = json_decode($response->getBody());

            return view('calculator.result')->with(compact('response'));
        }
        else
            return redirect()->route('calculator');

    }

}
