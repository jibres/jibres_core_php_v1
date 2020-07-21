<?php
namespace content_a\android\apk;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Build application'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		$app_queue = \lib\app\application\queue::detail();

		if(isset($app_queue['status']) && $app_queue['status'])
		{
			if(isset($app_queue['status']) && $app_queue['status'] === 'done')
			{
				$downoadAPK = \lib\store::url();
				\dash\data::downoadAPK($downoadAPK. '/app');
			}

			\dash\data::appQueue($app_queue);
		}

		\content_a\android\load::detail();

		\dash\data::global_scriptPage('a_app_queue.js');


	}
}
?>
