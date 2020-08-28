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
			'title'            => 'title',
			'website'          => 'website',
			'desc'             => 'desc',
			'logo'             => 'string_300',
			'lang'             => 'language',
			'status'           => ['enum' => ['enable', 'disable', 'close']],
			'address'          => 'address',
			'phone'            => 'phone',
			'mobile'           => 'mobile',
			'google_analytics' => 'string_50',
			'nosale'           => 'bit',
		];

		$require = ['title'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		if($data['google_analytics'])
		{
			if(!preg_match("/^[A-Za-z0-9\-]+$/", $data['google_analytics']))
			{
				\dash\notif::error(T_("Only Latin letter and number can use in google analytics code"), 'google_analytics');
				return false;
			}
		}

		return $data;
	}

}
?>