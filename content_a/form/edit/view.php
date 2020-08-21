<?php
namespace content_a\form\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit new contact form'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$form_id = \dash\request::get('id');

		// preview
		\dash\face::btnPreview(\lib\store::url(). '/f/'. $form_id);


		$items = \lib\app\form\item\get::items($form_id);

		\dash\data::formItems($items);

		\dash\data::itemType(\lib\app\form\item\type::list());
	}
}
?>
