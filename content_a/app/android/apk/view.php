<?php
namespace content_a\app\android\apk;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Build application'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		$app_queue = \lib\app\application\queue::detail();

		if(isset($app_queue['status']) && $app_queue['status'])
		{
			if(isset($app_queue['status']) && $app_queue['status'] === 'done')
			{
				$downoadAPK = \dash\url::set_subdomain(\lib\store::detail('subdomain'));
				\dash\data::downoadAPK($downoadAPK. '/app');
			}

			\dash\data::appQueue($app_queue);
		}

		\content_a\app\android\view::ready();



	}
}
?>
