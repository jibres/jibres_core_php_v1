<?php
namespace content_a\app\android\build;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Bulid application'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$appDetail = \lib\app\application\detail::get_android();
		\dash\data::appDetail($appDetail);

	}
}
?>
