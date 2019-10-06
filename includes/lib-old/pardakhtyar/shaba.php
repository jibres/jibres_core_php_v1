<?php
namespace lib\pardakhtyar;

class shaba
{
	public static function get($_shaba, $_desc = null)
	{
		$shaba =
		[
			'merchantIban' => $_shaba,
			// 'description'  => 'IBAN',
		];

		if($_desc)
		{
			$shaba['description'] = $_desc;
		}

		return $shaba;
	}
}
?>