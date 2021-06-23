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


		$args = \lib\app\form\form\check::variable($_args);

		if(!$args)
		{
			return false;
		}

		if(isset($args['inquirysetting']))
		{
			$_args['inquirysetting'] = 'JUST FOT NOT REMOVE IN PATHC MODE FUNCTION :)';
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

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