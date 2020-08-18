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

		$args['contain'] = \dash\request::get('contain');


		$dataTable = \lib\app\tax\docdetail\search::list(null, $args);
		\dash\data::dataTable($dataTable);

	}
}
?>
