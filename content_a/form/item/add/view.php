<?php
namespace content_a\form\item\add;


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
		\dash\face::btnDuplicate(\dash\url::this(). '/duplicate?id='. $form_id);


		\dash\face::btnInsert('form1');


		\dash\data::itemType(\lib\app\form\item\type::get_group());

		\dash\data::allAllowFileExt(\dash\upload\extentions::get_all_allow_ext());
	}
}
?>
