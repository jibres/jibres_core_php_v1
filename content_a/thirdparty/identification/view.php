<?php
namespace content_a\thirdparty\identification;


class view
{
	public static function config()
	{
		\dash\permission::access('aThirdPartyEdit');
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Edit identification detail'). \dash\data::page_title());
		\dash\data::page_desc(T_('set personal and birth identification detail and some other id detail like passport and etc'));
	}
}
?>
