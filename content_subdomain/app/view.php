<?php
namespace content_subdomain\app;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Download setting'));

		$appDetail = \lib\app\application\detail::get_dowload_page();
		\dash\data::appDetail($appDetail);


	}
}
?>
