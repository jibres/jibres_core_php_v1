<?php
namespace content_a\setup\shipping;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting up shipping rates'));

		$myCountryName = null;
		if(\dash\data::dataRow_country())
		{
			$myCountryName = \dash\utility\location\countres::get_name(\dash\data::dataRow_country(), true);
		}
		\dash\data::myCountryName($myCountryName);


		if(\dash\data::dataRow_currency())
		{
			$storeCurrency = \lib\currency::detail(\dash\data::dataRow_currency());
			\dash\data::storeCurrency($storeCurrency);
		}

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
