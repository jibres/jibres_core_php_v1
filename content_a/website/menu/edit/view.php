<?php
namespace content_a\website\menu\edit;



class view extends \content_a\website\menu\item\view
{
	public static function config()
	{
		parent::config();

		\dash\face::title(T_('Edit menu title'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '/setting?'. \dash\request::fix_get());

		\dash\face::btnSetting(null);


	}
}
?>