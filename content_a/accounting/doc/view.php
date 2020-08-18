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


		$dataTable = \lib\app\tax\doc\search::list(null, $args);
		\dash\data::dataTable($dataTable);

	}
}
?>
