<?php
namespace content_domain\contact\edit;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Edit account"));

		\dash\data::page_special(true);


		// btn
		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::this());
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