<?php
namespace content_a\report\sale;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Sale report'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		$args              = [];

		$args['startdate'] = \dash\request::get('startdate');
		$args['enddate']   = \dash\request::get('enddate');
		$args['groupby']   = \dash\request::get('groupby');

		$result = \lib\app\report\sale\get::master_report($args);

		\dash\data::masterReport($result);

	}
}
?>