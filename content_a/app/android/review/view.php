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

		$isReadyToCreate = \lib\app\application\detail::is_ready_to_create();
		\dash\data::isReadyToCreate($isReadyToCreate);

		\content_a\app\android\view::ready();



	}
}
?>
