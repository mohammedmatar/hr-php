<?php
namespace Models;
require_once 'vendor/rb.php';

/**
 *
 */
class Model extends \RedBeanPHP\SimpleModel {
	protected $tb_name;
	function __construct($tb_name) {
		# code...
		$this->tb_name = $tb_name;
		R::setup('mysql:host=localhost;dbname=hr_new',
			'root', '');
		R::setAutoResolve(TRUE);//Recommended as of version 4.2
		// $this->Salary = R::dispense($tb_name);
	}
	protected function retrive($id) {
		return R::load($tb_name, $id);
	}
}