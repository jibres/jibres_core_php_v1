<?php
namespace content_a\android\download;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Download setting'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$appDetail = \lib\app\application\detail::get_android();
		\dash\data::appDetail($appDetail);

		if(!\dash\data::appDetail_downloadtitle())
		{
			\dash\data::appDetail_downloadtitle(\lib\store::detail('title'));
		}
		if(!\dash\data::appDetail_downloaddesc())
		{
			\dash\data::appDetail_downloaddesc(\lib\store::detail('desc'));
		}
	}
}
?>
