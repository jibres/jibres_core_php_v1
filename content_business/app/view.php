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
		\dash\face::desc(T_("Download the app today! Shopping on the go is fast and easy with our free app. Enjoy more discounts on the our app and shop what's new & now"));

		$appDetail = \lib\app\application\detail::get_dowload_page();
		\dash\data::appDetail($appDetail);

		// back
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-app-1.jpg');
		\dash\face::twitterCard('summary_large_image');
	}
}
?>
