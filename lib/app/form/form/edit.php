<?php
namespace lib\app\form\form;


class edit
{
	public static function edit($_args, $_id)
	{
		\dash\permission::access('ManageForm');

		$load = \lib\app\form\form\get::get($_id);
		if(!$load)
		{
			return false;
		}


		$args = \lib\app\form\form\check::variable($_args, $_id);

		if(!$args)
		{
			return false;
		}

		$exception = [];

		if(isset($args['inquirysetting']))
		{
			$exception[] = 'inquirysetting';
		}

		if(isset($args['resultpagesetting']))
		{
			$exception[] = 'resultpagesetting';
		}

		if(array_key_exists('saveasticket', $_args))
		{
			$exception[] = 'setting';
		}


		if(array_key_exists('disableshortlink', $_args))
		{
			$exception[] = 'setting';
		}




		if(array_key_exists('beforestart', $_args))
		{
			$exception[] = 'setting';
		}



		if(array_key_exists('afterend', $_args))
		{
			$exception[] = 'setting';
		}




		if(array_key_exists('startdate', $_args))
		{
			$exception[] = 'starttime';
			$exception[] = 'endtime';
		}


		$args = \dash\cleanse::patch_mode($_args, $args, $exception);

		if(empty($args))
		{
			\dash\notif::info(T_("No data to change"));
			return false;
		}

		if(isset($args['status']) && $args['status'] === 'deleted')
		{
			$used_in_menu = \lib\app\menu\update::form($_id);
			if($used_in_menu)
			{
				\dash\notif::error(T_("This form used in menu and can not be remove"));
				return false;
			}

			if(floatval($_id) === floatval(\lib\store::detail('satisfaction_survey')))
			{
				\lib\app\store\edit::selfedit(['satisfaction_survey' => null]);
			}

			if(floatval($_id) === floatval(\lib\store::detail('shipping_survey')))
			{
				\lib\app\store\edit::selfedit(['shipping_survey' => null]);
			}


		}


		$args['datemodified'] = date("Y-m-d H:i:s");

		\lib\db\form\update::update($args, $_id);

		self::check_update_sitemap($load, $args, $_id);

		\dash\notif::ok(T_("Contact form successfully updated"));

		return true;
	}



	private static function check_update_sitemap($_data, $_args, $_id)
	{

		$need_update = false;

		$need_check = ['title', 'slug', 'lang', 'status', 'desc'];

		foreach ($_data as $key => $value)
		{
			if(in_array($key, $need_check))
			{
				if(isset($_args[$key]))
				{
					if(!\dash\validate::is_equal($value, $_args[$key]))
					{
						$need_update = true;
					}
				}
			}
		}

		if($need_update)
		{
			\dash\utility\sitemap::forms($_id);
		}
	}
}
?>