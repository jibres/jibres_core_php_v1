<?php
namespace content_a\android\review;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Download app.apk'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$isReadyToCreate = \lib\app\application\detail::is_ready_to_create();
		\dash\data::isReadyToCreate($isReadyToCreate);

		\content_a\android\load::detail();

		\dash\data::haveChangeAndroid(\lib\app\application\detail::need_to_rebuild());



	}
}
?>
