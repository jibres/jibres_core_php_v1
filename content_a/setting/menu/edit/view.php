<?php
namespace content_a\setting\menu\edit;



class view extends \content_a\setting\menu\item\view
{
	public static function config()
	{
		\dash\face::title(T_('Edit menu title'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '/setting?'. \dash\request::fix_get());

		\dash\face::btnSetting(null);


	}
}
?>