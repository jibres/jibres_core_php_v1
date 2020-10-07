<?php
namespace content_a\website\menu\edit;



class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit menu items'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/menu');


		\dash\face::btnSetting(\dash\url::that(). '/sort?'. \dash\request::fix_get());

		$list = \dash\data::menuDetail_list();

		if(!$list || !is_array($list))
		{
			$list = [];
		}

		\dash\data::menuDetailList($list);

		$usageList = \lib\app\website\menu\get::usage_list(\dash\data::menuDetail_key());
		\dash\data::usageList($usageList);
	}
}
?>
