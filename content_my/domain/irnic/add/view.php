<?php
namespace content_my\domain\irnic\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Add IRNIC handle"));

		if(\dash\request::get('type') === 'new')
		{
			\dash\face::title(T_("Create IRNIC handle"));
		}

		if(\dash\language::current() === 'fa')
		{
			\dash\face::help('https://help.jibres.ir/irnic/create-new-handle');
		}

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());
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