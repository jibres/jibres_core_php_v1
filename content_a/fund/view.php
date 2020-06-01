<?php
namespace content_a\fund;


class view
{
	public static function config()
	{

		\dash\face::title(T_('Choose fund'));

		\dash\data::back_text(T_('Sale'));
		\dash\data::back_link(\dash\url::here(). '/sale');

		$fund_list = \lib\app\fund\search::all_list();
		\dash\data::fundList($fund_list);

	}
}
?>
