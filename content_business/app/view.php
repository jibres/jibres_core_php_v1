<?php
namespace content_business\app;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Download App'). ' '. \dash\data::appDetail_downloadtitle(). ' | '. \lib\store::detail('title'));

		$appDetail = \lib\app\application\detail::get_dowload_page();
		\dash\data::appDetail($appDetail);

		// back
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>
