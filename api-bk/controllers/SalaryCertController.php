<?php

require_once 'inc/API.inc.php';
require_once 'models/Salary.php';
/**
 *
 */
class SalaryCertController extends API {

	protected $Salary;
	function __construct($request, $origin) {
		# code...
		parent::__construct($request);

		// Abstracted out for example
		// $APIKey = new Models\APIKey();
		$Salary = new Models\Salary();

		// if (!array_key_exists('apiKey', $this->request)) {
		// throw new Exception('No API Key provided');
		// } else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
		// throw new Exception('Invalid API Key');
		// } else if (array_key_exists('token', $this->request) &&
		// !$User->get('token', $this->request['token'])) {

		// throw new Exception('Invalid User Token');
		// }

		$this->Salary = $Salary;
	}
	protected function show() {
		if ($this->method == 'GET') {
			return "Your salary is ".$this->Salary->getBaseSalary();
		} else {
			return "Only accepts GET requests";
		}
	}
}