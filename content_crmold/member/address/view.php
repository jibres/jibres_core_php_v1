<?php
namespace content_crm\member\address;


class view
{
	public static function config()
	{
		\content_crm\member\main\view::dataRowMember();

		$args               = [];
		$args['user_id']    = \dash\coding::decode(\dash\request::get('id'));
		$args['pagenation'] = false;
		$args['status']     = 'enable';

		$dataTable          = \dash\app\address::list(null, $args);
		\dash\data::dataTable($dataTable);

		\dash\data::myUrlAddress(\dash\url::this(). '/address');

		\dash\face::title(T_('Member address'));

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