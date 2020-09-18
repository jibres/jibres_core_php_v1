<?php
namespace lib\app\form\item;


class edit
{

	public static function save_sort($_sort, $_form_id)
	{
		$_form_id = \dash\validate::id($_form_id);

		if(!is_array($_sort))
		{
			$_sort = [];
		}

		$new_sort = [];
		foreach ($_sort as $key => $value)
		{
			$key = \dash\validate::number($key);
			$value = \dash\validate::id($value);

			$new_sort[$key] = $value;
		}

		if(!empty($new_sort))
		{
			\lib\db\form_item\update::set_sort($_form_id, $new_sort);
			\dash\notif::ok(T_("Sort saved"));
			return true;
		}
	}


	private static $form_detail = [];

	public static function edit($_args, $_id, $_form_id)
	{

		if(isset(self::$form_detail[$_form_id]))
		{
			$load_form = self::$form_detail[$_form_id];
		}
		else
		{
			$load_form = \lib\app\form\form\get::get($_form_id);
			if(!$load_form)
			{
				return false;
			}
			self::$form_detail[$_form_id] = $load_form;
		}


		$load = \lib\app\form\item\get::get($_id);
		if(!$load)
		{
			return false;
		}

		$args = \lib\app\form\item\check::variable($_args, $_id, $load);

		if(!$args)
		{
			return false;
		}

		if(isset($args['setting']))
		{
			$_args['setting'] = $args['setting'];
		}

		if(isset($args['choice']))
		{
			$_args['choice'] = $args['choice'];
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		foreach ($args as $key => $value)
		{
			if(\dash\validate::is_equal(\dash\get::index($load, $key), $value))
			{
				unset($args[$key]);
			}
		}

		if(empty($args))
		{
			\dash\notif::info(T_("No data to change"));
			return false;
		}

		$args['datemodified'] = date("Y-m-d H:i:s");

		\lib\db\form_item\update::update($args, $_id);

		return true;
	}
}
?>