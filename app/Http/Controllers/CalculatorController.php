<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests\QuotationFormRequest;

class CalculatorController extends Controller
{
/*
    private $quote;

    public function __construct(Quote $quote)
    {
        $this->quote = $quote;
    }
*/
    public function index()
    {
        return view('calculator.calculator');
    }

    public function result()
    {
        phpinfo();

        //dd($request->except("_token"));
        return view('calculator.result');
    }

}
