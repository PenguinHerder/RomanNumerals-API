<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RomanNumber extends Model
{
	public $incrementing = false;
	protected $table = 'roman_numbers';
    protected $fillable = ['id', 'roman', 'request_count'];

    public function requests() {
    	return $this->hasMany(\App\ConversionRequest::class, 'roman_number_id', 'id');
    }
}
