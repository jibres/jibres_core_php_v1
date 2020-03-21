<?php
namespace content_a\app\android\review;


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

		$isReadyToCreate = \lib\app\application\detail::is_ready_to_create($appDetail);
		\dash\data::isReadyToCreate($isReadyToCreate);


		$app_queue = \lib\app\application\queue::detail();

		if(isset($app_queue['status']) && $app_queue['status'] === 'done')
		{
			$downoadAPK = \dash\url::set_subdomain(\lib\store::detail('subdomain'));
			\dash\data::downoadAPK($downoadAPK. '/app');
		}

		\dash\data::appQueue($app_queue);

		\content_a\app\android\view::ready();



	}
}
?>
