<?php
namespace lib\app\factor;


class cart
{

	/**
	 * add new factor
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function to_factor($_args)
	{
		$condition =
		[
			'address_id' => 'code',
			'payway'     => ['enum' => ['online']],
		];


		$require = ['payway', 'address_id'];

		$meta =
		[
			'field_title' =>
			[
				'payway' => 'Payment',
				'address_id' => 'Address',
			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		var_dump($data);exit();
	}
}
?>