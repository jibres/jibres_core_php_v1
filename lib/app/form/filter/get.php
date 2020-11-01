<?php
namespace lib\app\form\filter;


class get
{


	public static function get($_id)
	{
		\dash\permission::access('AdvanceFormAnalyze');

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$load = \lib\db\form_filter\get::by_id($id);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\app\form\filter\ready::row($load);

		return $load;
	}


	public static function all_form_filter($_form_id)
	{
		\dash\permission::access('AdvanceFormAnalyze');

		$id = \dash\validate::id($_form_id);
		if(!$id)
		{
			return false;
		}

		$load = \lib\db\form_filter\get::by_form_id($id);

		if(!is_array($load))
		{
			$load = [];
		}

		$load = array_map(['\\lib\\app\\form\\filter\\ready', 'row'], $load);

		return $load;
	}


	public static function where_list($_filter_id, $_form_id)
	{
		\dash\permission::access('AdvanceFormAnalyze');

		$id = \dash\validate::id($_filter_id);

		if(!$id)
		{
			return false;
		}

		$load_form = \lib\app\form\form\get::get($_form_id);
		if(!$load_form)
		{
			return false;
		}

		$load = \lib\db\form_filter\get::where_list_filter_id($id);

		if(!is_array($load))
		{
			$load = [];
		}


		$fields = \lib\app\form\form\ready::fields($load_form);

		$fields = array_combine(array_column($fields, 'field'), $fields);


		$new_result = [];
		foreach ($load as $key => $value)
		{
			$new_result[] = \lib\app\form\filter\ready::row_where($value, $fields);
		}

		return $new_result;
	}




}
?>