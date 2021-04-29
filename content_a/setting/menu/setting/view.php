<?php
namespace content_a\setting\menu\setting;



class view extends \content_a\website\menu\item\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('Sort menu items'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '/roster?'. \dash\request::fix_get());

		\dash\face::btnSetting(null);

		// $usageList = \lib\app\website\menu\get::usage_list(\dash\data::menuDetail_key());
		// \dash\data::usageList($usageList);

	}
}
?>