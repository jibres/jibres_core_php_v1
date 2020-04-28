<?php
namespace lib\app\shaparak\terminal;


class add
{
	public static function new_terminal($_user_id)
	{
		$insert =
		[
			'user_id'         => $_user_id,
			'sequence'        => null,
			'terminalNumber'  => null,
			'terminalType'    => 1,
			'serialNumber'    => null,
			'setupDate'       => date("Y-m-d H:i:s"),
			'hardwareBrand'   => null,
			'hardwareModel'   => null,
			'accessAddress'   => null,
			'accessPort'      => null,
			'callbackAddress' => null,
			'callbackPort'    => null,
			'Description'     => null,
			'datecreated'     => date("Y-m-d H:i:s"),
		];

		$terminal_id = \lib\db\shaparak\terminal\insert::new_record($insert);

		$terminalNumber = '1'. str_pad((string) $terminal_id, 7, "0", STR_PAD_LEFT);

		\lib\db\shaparak\terminal\update::update(['terminalNumber' => $terminalNumber], $terminal_id);

		$insert['terminalNumber'] = $terminalNumber;

		return $insert;

	}
}
?>