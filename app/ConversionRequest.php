<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConversionRequest extends Model
{
	public $timestamps = false;
	protected $table = 'conversion_requests';
    protected $fillable = ['roman_number_id', 'request_date'];
    protected $dates = ['request_date'];

    public function romanNumber() {
    	return $this->belongsTo(\App\RomanNumber::class, 'roman_number_id', 'id');
    }
}
