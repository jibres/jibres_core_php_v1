<?php
namespace content_a\form\duplicate;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Duplicate form'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$form_id = \dash\request::get('id');

		// preview
		\dash\face::btnPreview(\lib\store::url(). '/f/'. $form_id);
	}
}
?>
