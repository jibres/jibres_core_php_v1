<?php
namespace content_a\accounting\docdetail;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Accounting Documents detail'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());




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

		if($year_id)
		{
			$args['year_id'] = $year_id;
		}

		$args['contain']   = \dash\request::get('contain');
		$args['group']     = \dash\request::get('group');
		$args['total']     = \dash\request::get('total');
		$args['assistant'] = \dash\request::get('assistant');
		$args['details']   = \dash\request::get('details');

		$dataTable = \lib\app\tax\docdetail\search::list(\dash\request::get('q'), $args);
		\dash\data::dataTable($dataTable);

		\dash\data::groupList(\lib\app\tax\coding\get::current_list_of('group'));
		\dash\data::totalList(\lib\app\tax\coding\get::current_list_of('total', \dash\request::get('group')));
		\dash\data::assistantList(\lib\app\tax\coding\get::current_list_of('assistant', \dash\request::get('group'), \dash\request::get('total')));
		// \dash\data::detailsList(\lib\app\tax\coding\get::current_list_of('details', \dash\request::get('group'), \dash\request::get('total'), \dash\request::get('assistant')));

	}
}
?>
