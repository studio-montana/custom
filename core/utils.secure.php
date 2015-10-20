<?php

/**
 * Custom utilities for security
 * @package WordPress
 * @subpackage Custom
 * @since Custom 1.0
 * @author Sébastien Chandonay www.seb-c.com / Cyril Tissot www.cyriltissot.com
 */

/**
 * Captcha class
 */
class Captcha{

	public $captcha_formule;
	public $captcha_result;
	public $captcha_result_salt;
	public static $captcha_salt = 57463;

	public function __construct() {
		$first = rand(1, 10);
		$second = rand(1, 10);
		$this->captcha_formule = "$first + $second";
		$this->captcha_result = ($first + $second);
		$this->captcha_result_salt = self::$captcha_salt.$this->captcha_result;
	}
}