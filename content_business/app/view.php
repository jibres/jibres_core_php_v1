<?php
namespace content_business\app;


class view
{
	public static function config()
	{
		$myTitle = T_('Download App');
		if(\dash\data::appDetail_downloadtitle())
		{
			$myTitle .= ' '. \dash\data::appDetail_downloadtitle();
		}
		$myTitle .= ' | '. \lib\store::detail('title');

		\dash\face::title($myTitle);

		$appDetail = \lib\app\application\detail::get_dowload_page();
		\dash\data::appDetail($appDetail);

		// back
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>
