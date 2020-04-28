<?php
namespace lib\app\shaparak\contract;


class add
{
	public static function new_contract($_user_id)
	{
		$insert =
		[
			'user_id'          => $_user_id,

			'contractDate'     => date("Y-m-d H:i:s"),
			'expiryDate'       => null,
			'serviceStartDate' => date("Y-m-d H:i:s"),
			'contractNumber'   => null,
			'description'      => null,

			'datecreated'      => date("Y-m-d H:i:s"),
		];

		$contract_id = \lib\db\shaparak\contract\insert::new_record($insert);

		$contractNumber = 'Jibres-contract'. str_pad((string) $contract_id, 6, "0", STR_PAD_LEFT);

		\lib\db\shaparak\contract\update::update(['contractNumber' => $contractNumber], $contract_id);

		$insert['contractNumber'] = $contractNumber;

		return $insert;

	}
}
?>