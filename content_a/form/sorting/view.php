<?php
namespace content_a\form\sorting;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit new contact form'));
		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));


		$form_id = \dash\request::get('id');

		$items = \lib\app\form\item\get::items($form_id);

		\dash\data::formItems($items);

	}
}
?>
