<?php
namespace content_a\accounting\doc;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Accounting Documents'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		// back
		\dash\data::action_text(T_('Add doc'));
		\dash\data::action_link(\dash\url::that(). '/add');

		\dash\data::userToggleSidebar(false);



		$year = \lib\app\tax\year\get::list();
		\dash\data::accountingYear($year);

		$args = [];

		$year_id = \dash\request::get('year_id');
		if(!$year_id)
		{
			foreach ($year as $key => $value)
			{
				if(isset($value['isdefault']) && $value['isdefault'])
				{
					$year_id = $value['id'];
					break;
				}
			}
		}


		$args['contain']   = \dash\request::get('contain');

		$startdate         = \dash\request::get('startdate');
		$startdate         = \dash\validate::date($startdate, false);
		$enddate           = \dash\request::get('enddate');
		$enddate           = \dash\validate::date($enddate, false);

		$args['year_id']   = $year_id;
		$args['startdate'] = $startdate ? $startdate : null;
		$args['enddate']   = $enddate ? $enddate : null;
		$args['month']     = \dash\request::get('month');



		$dataTable = \lib\app\tax\doc\search::list(\dash\request::get('q'), $args);
		\dash\data::dataTable($dataTable);

	}
}
?>
