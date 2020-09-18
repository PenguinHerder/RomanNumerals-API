<?php

namespace App;

class IntegerConversion implements IntegerConversionInterface
{
	protected $table = [];

	public function __construct() {
		$this->generateTable();
	}

	/**
     * Convert integer into roman numeral
     * 
     * @param integer $integer
     *
     * @return string
     */
	public function toRomanNumerals($integer) {
		$ret = '';

		foreach ($this->table as $roman => $value) {
			if ($integer >= $value) {
				$ret .= $roman;
				$integer -= $value;

				if ($integer < 1) {
					break;
				}
			}
		}

		return $ret;
	}

	/**
     * Generate array of roman_representation => threshold in a threshold descending manner
     */
	protected function generateTable() {
		$settings = [	
			'M' => ['value' => 1000, 'max' => 3, 'remover' => 'C'],
			'D' =>['value' => 500, 'max' => 1, 'remover' => 'C'],
			'C' =>['value' => 100, 'max' => 3, 'remover' => 'X'],
			'L' =>['value' => 50, 'max' => 1, 'remover' => 'X'],
			'X' =>['value' => 10, 'max' => 3, 'remover' => 'I'],
			'V' =>['value' => 5, 'max' => 1, 'remover' => 'I'],
			'I' =>['value' => 1, 'max' => 3, 'remover' => null],
		];

		foreach ($settings as $sign => $data) {
			$repeat = $data['max'];
			while ($repeat > 0) {
				$roman = str_repeat($sign, $repeat);
				$this->table[$roman] = $data['value'] * $repeat;
				$repeat--;
			}

			if ($data['remover']) {
				$roman = $data['remover'] . $sign;
				$this->table[$roman] = $data['value'] - $settings[$data['remover']]['value'];
			}
		}
	}
}