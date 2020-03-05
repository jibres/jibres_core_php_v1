<?php
namespace content_a\app\android\apk;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Download app.apk'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$appDetail = \lib\app\application\detail::get_android();
		\dash\data::appDetail($appDetail);


		$list = glob(YARD . 'talambar_cloud/'. \dash\url::store() . '/app/*');
		\dash\data::apiList($list);

	}
}
?>
