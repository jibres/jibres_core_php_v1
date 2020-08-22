<?php
namespace content_account\my\address;


class view
{

	public static function config()
	{
		\dash\face::title(T_('Addresses'));


		\dash\data::myUrlAddress(\dash\url::that());

		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('Personal info'));


		// back
		\dash\data::back_text(T_('Personal info'));
		\dash\data::back_link(\dash\url::this());


		$args               = [];
		$args['user_id']    = \dash\user::id();
		$args['pagenation'] = false;
		$args['status']     = 'enable';

		$dataTable          = \dash\app\address::list(null, $args);
		\dash\data::dataTable($dataTable);

		self::static_var();

	}

	private static function static_var()
	{
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
