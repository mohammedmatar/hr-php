<?php 
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json');
$data = {
  "date": "15-02-1990",
  "name": "Mohammed Matar",
  "bssalary": "2500",
  "salary": 5000,
  "hsallowance": 500,
  "total": 6000
};
echo json_encode($data);
?>
