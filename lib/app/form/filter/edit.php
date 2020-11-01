<?php
namespace lib\app\form\filter;


class edit
{

	public static function fields($_form_id, $_fields)
	{
		\dash\permission::access('AdvanceFormAnalyze');

		$_form_id = \dash\validate::id($_form_id);

		$load_form = \lib\app\form\form\get::get($_form_id);
		if(!$load_form)
		{
			return false;
		}

		if(!is_array($_fields))
		{
			$_fields = [];
		}

		$current_field = array_keys($_fields);

		$form_field = $load_form['analyzefield'];
		$form_field = json_decode($form_field, true);

		if(!is_array($form_field))
		{
			\dash\log::oops('formFieldIsNotArray');
			\dash\notif::error(T_("Invalid field"));
			return false;
		}

		foreach ($form_field as $key => $value)
		{
			if(in_array($key, $current_field))
			{
				$form_field[$key]['visible'] = true;
			}
			else
			{
				$form_field[$key]['visible'] = false;
			}
		}

		$form_field = json_encode($form_field, JSON_UNESCAPED_UNICODE);
		\lib\db\form\update::update(['analyzefield' => $form_field], $_form_id);

		\dash\notif::ok(T_("Column customized"));
		return true;
	}

}
?>