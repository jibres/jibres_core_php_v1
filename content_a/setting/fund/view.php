<?php
namespace content_a\setting\fund;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Fund detail'). ' | '. \dash\data::store_name());
		\dash\data::page_desc(T_('Fund detail'));

		$args = [];
		$args['pagenation'] = false;

		$fund_list = \lib\app\fund::list(null, $args);

		\dash\data::dataTable($fund_list);

		$pos_list = \lib\app\store\pos::list();
		\dash\data::posList($pos_list);

		self::static_var();
	}

	private static function static_var()
	{

		$countryList = \dash\utility\location\countres::$data;
		\dash\data::countryList($countryList);

		$cityList    = \dash\utility\location\cites::$data;
		$proviceList = \dash\utility\location\provinces::key_list('localname');

		$new = [];
		foreach ($cityList as $key => $value)
		{
			$temp = '';

			if(isset($value['province']) && isset($proviceList[$value['province']]))
			{
				$temp .= $proviceList[$value['province']]. ' - ';
			}
			if(isset($value['localname']))
			{
				$temp .= $value['localname'];
			}
			$new[$key] = $temp;
		}
		asort($new);

		\dash\data::cityList($new);
	}
}
?>