<?php
namespace content_a\report\saleproductdate;

class view
{
	public static function config()
	{
		\dash\permission::access('_group_setting');

		\dash\face::title(T_('Sale Product per date'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$date = \dash\request::get('date');
		if(!$date)
		{
			$date = \dash\fit::date_en(date("Y-m-d"));
		}

		\dash\data::currentDate($date);


	}
}
?>