<?php
namespace lib\app\setting;


class policy_page
{
	public static function set($_args)
	{

		$condition =
		[
			'aboutus_page'               => 'code',
			'refund_policy_page'         => 'code',
			'privacy_policy_page'        => 'code',
			'termsofservice_policy_page' => 'code',
			'shipping_policy_page'       => 'code',
		];

		$data = \dash\cleanse::input($_args, $condition, [], []);

		$args = \dash\cleanse::patch_mode($_args, $data);

		foreach ($args as $key => $value)
		{
			$args[$key] = \dash\coding::decode($value);
		}

		$cat  = 'store_setting';

		foreach ($args as $key => $value)
		{
			\lib\app\setting\tools::update($cat, $key, $value);
		}

		\dash\notif::ok(T_("Saved"));

		return true;

	}



	public static function admin_load()
	{
		$all_setting                        = \lib\store::detail();

		$data                               = [];
		$data['aboutus_page']               = a($all_setting, 'store_data', 'aboutus_page');
		$data['refund_policy_page']         = a($all_setting, 'store_data', 'refund_policy_page');
		$data['privacy_policy_page']        = a($all_setting, 'store_data', 'privacy_policy_page');
		$data['termsofservice_policy_page'] = a($all_setting, 'store_data', 'termsofservice_policy_page');
		$data['shipping_policy_page']       = a($all_setting, 'store_data', 'shipping_policy_page');


		$ids = array_filter($data);
		$ids = array_unique($ids);

		$ids = array_map('floatval', $ids);

		if($ids)
		{

			$ids = array_map(['\\dash\\coding', 'encode'], $ids);

			$load_multi_post = \dash\app\posts\get::get_multi_post($ids);

			if(!is_array($load_multi_post))
			{
				$load_multi_post = [];
			}

			$load_multi_post = array_combine(array_column($load_multi_post, 'id'), $load_multi_post);

			foreach ($data as $key => $value)
			{
				if($value && is_numeric($value))
				{
					$encoded = \dash\coding::encode($value);
					if(isset($load_multi_post[$encoded]))
					{
						$data[$key] = ['id' => $value, 'code' => $encoded, 'detail' => $load_multi_post[$encoded]];
					}
				}
			}
		}

		return $data;
	}
}
?>