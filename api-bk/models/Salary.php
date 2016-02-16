<?php

namespace Models;

/**
 *
 */
class Salary extends Model {
	private $baseSalary;

	function __construct() {
		# code...
		parent::__construct('tb_salary');
	}
	public function getBaseSalary() {
		// $post = R::load( '', $id );   //Retrieve
		echo retrive();
		return retrive();
	}
	public function setBaseSalary() {
		// return
	}
}