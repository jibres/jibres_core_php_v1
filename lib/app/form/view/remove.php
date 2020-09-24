<?php
namespace lib\app\form\view;


class remove
{

	public static function remove($_form_id)
	{
		$laod_form = \lib\app\form\form\get::get($_form_id);

		if(!$laod_form || !isset($laod_form['id']))
		{
			return false;
		}

		$form_id = $laod_form['id'];

		$table_name = \lib\app\form\view\get::is_created_table($form_id);
		if(!$table_name)
		{
			\dash\notif::error(T_("No analyze table founded"));
			return false;
		}

		$update_form =
		[
			'analyzefield' => null,
			'analyze'      => null,
		];

		\lib\db\form\update::update($update_form, $form_id);

		\lib\db\form_view\delete::view_table($table_name);

		\lib\db\form_filter\delete::all_filter($form_id);

		\dash\notif::delete(T_("Analyze removed"));
		return true;

	}

}
?>