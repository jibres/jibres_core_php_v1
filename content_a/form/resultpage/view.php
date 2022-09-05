<?php
namespace content_a\form\resultpage;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Result page'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));

		$form_id = \dash\request::get('id');

		\dash\face::btnSave('form1');

		$items = \lib\app\form\item\get::items_resulpageable($form_id);

		\dash\data::formItems($items);
	}
}
?>
