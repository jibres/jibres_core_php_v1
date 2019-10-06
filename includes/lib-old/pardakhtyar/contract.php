<?php
namespace lib\pardakhtyar;

class contract
{
	public static function get($_args = null, $_isUpdate = false)
	{
		$myContractData =
		[
			'contractDate'     => strtotime('now'). '000',
			// without expire date
			// 'expiryDate'       => strtotime('2020-07-25'). '000',
			'serviceStartDate' => strtotime('now'). '000',
			'contractNumber'   => "C-test2-". time(),
			'description'      => 'Contract Test',
			'updateAction'     => 0,
		];


		if($myContractData)
		{
			$myShop['updateAction'] = 2;
		}

		return $myContractData;
	}

}
?>