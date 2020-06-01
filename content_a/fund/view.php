<?php
namespace content_a\fund;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Choose fund'));

		$fund_list = \lib\app\fund\search::all_list();
		\dash\data::fundList($fund_list);

	}
}
?>
