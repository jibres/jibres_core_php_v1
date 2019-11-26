<?php
namespace lib\pardakhtyar\app\shaparak;


class transfer
{

	public static function run()
	{
		$json_sample =
		'[
		  {
		    "sourceIban": "IR111111111111111111111111",
		    "transferType": 0,
		    "transactionDate": 1533168000000,
		    "trackingNumber": "13970511PF010000001",
		    "referenceNumber": "TRX01-13970511-01",
		    "amount": 7000,
		    "destinationIban": "IR222222222222222222222222",
		    "ownerName": "مالک سپرده تستی 2",
		    "ownerNationalId": "1111111111",
		    "شرح تراکنش": "description "
		  },
		  {
		    "sourceIban": "IR111111111111111111111111",
		    "transferType": 0,
		    "transactionDate": 1533168000000,
		    "trackingNumber": "13970511PF010000001",
		    "referenceNumber": "TRX01-13970511-01",
		    "amount": 7000,
		    "destinationIban": "IR333333333333333333333333",
		    "ownerName": "مالک سپرده تستی 2",
		    "ownerNationalId": "2222222222",
		    "شرح تراکنش 2": "description "
		  }
		]';

		$json_sample = json_decode($json_sample, true);

		$result = \lib\pardakhtyar\start::transfer($json_sample);
		var_dump($result);exit();
		return \lib\pardakhtyar\app\shaparak\request::analyze_result($result);
	}

}
?>