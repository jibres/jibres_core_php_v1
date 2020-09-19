<?php
namespace content_a\form\item\choice;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage item choice'));

			// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/item?'. \dash\request::fix_get());

		$choice = \lib\app\form\choice\get::choice_item(\dash\request::get('item'));
		\dash\data::choiceList($choice);

	}
}
?>
