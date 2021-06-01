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
			'termsofservice_page' => 'code',
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


	public static function get_page_key()
	{
		return
		[
			'aboutus_page'         => ['title' => T_("About Us page"), 'slug' => 'about'],
			'refund_policy_page'   => ['title' => T_("Refund policy page"), 'slug' => 'refund-policy'],
			'privacy_policy_page'  => ['title' => T_("Privacy policy page"), 'slug' => 'privacy'],
			'termsofservice_page'  => ['title' => T_("Terms of service page"), 'slug' => 'terms'],
			'shipping_policy_page' => ['title' => T_("Shipping policy page"), 'slug' => 'shipping-policy'],
		];

	}


	public static function is_policy_page($_post_id)
	{
		$post_id = \dash\coding::decode($_post_id);

		$all_setting                        = \lib\store::detail();

		$pages = self::get_page_key();

		foreach (array_keys($pages) as $key => $value)
		{
			if(floatval(a($all_setting, 'store_data', $value)) === floatval($post_id))
			{
				return a($pages, $value);
			}
		}

		return false;
	}



	public static function admin_load()
	{
		$all_setting                        = \lib\store::detail();

		$data                         = [];
		$data['aboutus_page']         = a($all_setting, 'store_data', 'aboutus_page');
		$data['refund_policy_page']   = a($all_setting, 'store_data', 'refund_policy_page');
		$data['privacy_policy_page']  = a($all_setting, 'store_data', 'privacy_policy_page');
		$data['termsofservice_page']  = a($all_setting, 'store_data', 'termsofservice_page');
		$data['shipping_policy_page'] = a($all_setting, 'store_data', 'shipping_policy_page');


		$ids = array_filter($data);
		$ids = array_unique($ids);

		$ids = array_map('floatval', $ids);

		if($ids)
		{

			$ids = array_map(['\\dash\\coding', 'encode'], $ids);

			\dash\temp::set('cmsPostNeedEditLink', true);

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



	public static function create_from_template($_mode)
	{
		$module = self::get_page_key();

		if(is_string($_mode) && in_array($_mode, array_keys($module)))
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Invalid mode"));
			return false;
		}



		$content = self::static_page_template($_mode);

		if($content)
		{
			$slug    = a($module, $_mode, 'slug');
			$special = 'special';

			if(\dash\db\posts\get::check_duplicate_slug($slug))
			{
				$slug    = null;
				$special = 'independence';
			}

			$args =
			[
				'title'          => a($module, $_mode, 'title'),
				'slug'           => $slug,
				'specialaddress' => $special,
				'status'         => 'publish',
				'content'        => $content,
			];

			$post_id = \dash\app\posts\add::add($args);

			\dash\notif::clean();

			if(isset($post_id['post_id']))
			{
				self::set([$_mode => $post_id['post_id']]);

				return $post_id['post_id'];
			}
		}
	}



	private static function static_page_template($_mode)
	{
		$lang = \dash\language::current();

		$addr = __DIR__. '/template_policy_page';

		$file_addr = $addr . '/'. $_mode . '.php';

		$file_addr_lang = $addr . '/'. $_mode. '_'. $lang . '.php';

		if(is_file($file_addr_lang))
		{
			require_once($file_addr_lang);
		}
		elseif(is_file($file_addr))
		{
			require_once($file_addr);
		}

		if(isset($template))
		{
			return $template;
		}

		return null;

	}


}
?>