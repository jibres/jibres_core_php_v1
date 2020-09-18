<?php
namespace content_a\form\item;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit item'));

			// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));

		$form_id = \dash\request::get('id');


		\dash\face::btnSave('form1');

		\dash\data::allAllowFileExt(\dash\upload\extentions::get_all_allow_ext());
	}
}
?>
