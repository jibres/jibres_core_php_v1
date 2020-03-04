<?php
namespace content_a\app\android;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Android Application'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());


		$app_queue = \lib\app\application\queue::detail();
		\dash\data::appQueue($app_queue);
	}
}
?>
