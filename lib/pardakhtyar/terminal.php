<?php
namespace lib\pardakhtyar;

class terminal
{
	/**
	 * for each person we need below values!
	 * for person1 and person2 and so on...
	 * @return [type] [description]
	 */
	public static function get()
	{
		$myTerminal =
		[
			[
				// require
				'sequence'        => null,
				'terminalNumber'  => 37196175,
				'terminalType'    => 1,

				'serialNumber'    => null,

				'setupDate'       => time(). '000',
				'hardwareBrand'   => null,
				'hardwareModel'   => null,

				'accessAddress'   => 'jibres.com',
				'accessPort'      => 443,
				'callbackAddress' => 'jibres.com',
				'callbackPort'    => 443,

				"updateAction"    => 0,
				// 'description'     => 'main terminal of Jibres',
			]
		];

		return $myTerminal;
	}

}
?>