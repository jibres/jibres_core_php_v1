<?php
namespace lib\app\form\item;


class edit
{
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
			// \dash\notif::info(T_("No data to change"));
			return false;
		}

		$args['datemodified'] = date("Y-m-d H:i:s");

		\lib\db\form_item\update::update($args, $_id);

		return true;
	}
}
?>