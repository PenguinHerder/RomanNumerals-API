<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\RomanNumber;
use App\ConversionRequest;
use App\IntegerConversion;
use Illuminate\Http\Request;
use App\Http\Requests\RomanConvertRequest;
use App\Http\Resources\RomanNumberCollection;
use App\Http\Resources\ConversionRequestCollection;
use App\Http\Resources\RomanNumber as RomanNumberResource;

class RomanController extends Controller
{
    /**
     * Convert integer into roman numeral endpoint
     */
    public function convert(RomanConvertRequest $request, $number) {
    	$romanNumber = RomanNumber::find((int)$number);

    	if ($romanNumber) {
    		$romanNumber->request_count = $romanNumber->request_count + 1;
    		$romanNumber->save();
    	} else {
    		$conversion = new IntegerConversion();
    		$roman = $conversion->toRomanNumerals($number);

    		$romanNumber = RomanNumber::create([
    			'id' => (int)$number,
    			'roman' => $roman,
    			'request_count' => 1,
    		]);
    	}

    	$romanNumber->requests()->create(['request_date' => Carbon::now()]);
    	
    	return new RomanNumberResource($romanNumber);
    }

    /**
     * Return recent conversion request log endpoint
     */
    public function recent(Request $request) {
        // laravel 5.6 explodes on php 7.4 due to a deprecated method use, hack it around
        error_reporting(E_ALL & ~E_DEPRECATED);
    	$conversions = ConversionRequest::with('romanNumber')->orderBy('request_date', 'desc')->paginate(10);

    	return new ConversionRequestCollection($conversions);
    }

    /**
     * Return most requested integers endpoint
     */
    public function top(Request $request) {
    	$numbers = RomanNumber::orderBy('request_count', 'desc')->orderBy('updated_at', 'desc')->limit(10)->get();

    	return new RomanNumberCollection($numbers);
    }
}
