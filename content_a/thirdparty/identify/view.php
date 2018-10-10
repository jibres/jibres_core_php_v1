<?php
namespace content_a\thirdparty\identify;


class view
{
	public static function config()
	{
		\dash\permission::access('aThirdPartyEdit');
		\content_a\thirdparty\load::dataRow();
		\content_a\thirdparty\load::static_var();

		\dash\data::page_title(T_('Edit identification detail'). \dash\data::page_title());
		\dash\data::page_desc(T_('set personal and birth identification detail and some other id detail like passport and etc'));
	}
}
?>
