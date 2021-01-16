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
			'title'                         => 'title',
			'website'                       => 'website',
			'desc'                          => 'desc',
			'logo'                          => 'string_300',
			'lang'                          => 'language',
			'status'                        => ['enum' => ['enable', 'disable', 'close']],
			'address'                       => 'address',
			'phone'                         => 'phone',
			'mobile'                        => 'mobile',
			'google_analytics'              => 'string_50',
			'addon_tawk'                    => 'string_50',
			'addon_imber'                   => 'string_50',
			'addon_raychat'                 => 'string_50',
			'enamad'                        => 'string_100',
			'nosale'                        => 'bit',
			'samandehi_link1'               => 'url',
			'samandehi_link2'               => 'url',

			'redirect_all_domain_to_master' => 'bit',
			'redirect_jibres_subdomain_to_master' => 'bit',
		];

		$require = ['title'];

		$meta =	[];


		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(substr_count($data['title'], ' ') > 8)
		{
			\dash\notif::error(T_("You can use less than 8 space character in business name"));
			return false;
		}

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