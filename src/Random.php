<?php
namespace jpuck\dbdtp;
use RandomLib\Factory;
use RuntimeException;

class Random {
	protected $characters = [
		'lowercase' => 'abcdefghijklmnopqrstuvwxyz',
		'uppercase' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		'numbers'   => '0123456789',
		'special'   => '{[(</|>)]} `~!@#$%^&*-_=+;:,.?',
	];

	public function id(Int $length = 5) : String {
		$chars =
			$this->characters['lowercase'] .
			$this->characters['uppercase'] .
			$this->characters['numbers'];
		return $this->generate($length, $chars);
	}

	public function password(Int $length = 32) : String {
		// http://stackoverflow.com/a/31634299/4233593
		$chars = implode('', $this->characters);
		return $this->generate($length, $chars);
	}

	protected function generate(Int $length, String $chars) : String {
		return ($this->generator ?? $this->generator = (new Factory)
			->getMediumStrengthGenerator())
			->generateString($length, $chars);
	}
}
