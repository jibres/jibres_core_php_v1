<?php
namespace lib\app\form\filter;


class run
{
	public static function count_all($_form_id, $_filter_id)
	{
		$where_list = \lib\app\form\filter\get::where_list($_filter_id, $_form_id);

		$table_name	 = \lib\app\form\view\get::is_created_table($_form_id);


		if(!$table_name)
		{
			\dash\notif::error(T_("Table not created"));
			return false;
		}

		$count_all = \lib\db\form_view\search_table::get_count_all($table_name);

		return $count_all;

	}


	public static function run($_form_id, $_filter_id)
	{
		$table_name	 = \lib\app\form\view\get::is_created_table($_form_id);

		$where_list = \lib\app\form\filter\get::where_list($_filter_id, $_form_id);

		if(!$table_name)
		{
			\dash\notif::error(T_("Table not created"));
			return false;
		}

		$count_all = \lib\db\form_view\search_table::get_count_all($table_name);

		$count_before = $count_all;

		$all_where = [];

		foreach ($where_list as $key => $value)
		{
			if(isset($value['query_condition']))
			{
				$temp = " `$table_name`.$value[field] $value[query_condition] ";
				if(isset($value['value']) && $value['value'])
				{
					$temp .= " '$value[value]' ";
				}

				$all_where[] = $temp;
				$this_where  = $temp;
				$inside      = \lib\db\form_view\search_table::get_count_where($table_name, [$this_where]);
				$count_after = \lib\db\form_view\search_table::get_count_where($table_name, $all_where);
				$outside     = $count_all - $inside;

				\lib\db\form_filter\update::update_filter_where(['inside' => $inside, 'outside' => $outside, 'count_before' => $count_before, 'count_after' => $count_after], $value['id']);

				$count_before = $count_after;
			}
		}

		\dash\notif::ok(T_("Filter executed"));
	}


}
?>