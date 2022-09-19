<?php
namespace content_a\form\item\choice;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage item choice'));

		\content_a\form\edit\view::form_preview_link();

		\dash\data::back_link(\dash\url::this(). '/item?'. \dash\request::fix_get());

		$choice = \lib\app\form\choice\get::choice_item(\dash\request::get('item'));
		\dash\data::choiceList($choice);

	}
}
?>
