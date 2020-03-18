<?php
namespace lib\app\store;


class check
{

	public static function variable($_args, $_option = [])
	{
		$default_option =
		[
			'debug'   => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		$condition =
		[
			'title'   => 'title',
			'website' => 'website',
			'desc'    => 'desc',
			'lang'    => 'lang',
			'status'  => ['enum' => ['enable', 'disable', 'close']],
			'address' => 'address',
			'phone'   => 'phone',
			'mobile'  => 'mobile',
		];

		$require = ['title'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}

}
?>