<?php
namespace content_a\accounting\report\detail;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Accounting report detail'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$year = \lib\app\tax\year\get::list();
		\dash\data::accountingYear($year);


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

		$report = \lib\app\tax\doc\report::detail_report($year_id);
		\dash\data::reportDetail($report);

	}

}
?>
