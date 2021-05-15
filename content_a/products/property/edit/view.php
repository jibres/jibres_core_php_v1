<?php
namespace content_a\products\property\edit;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		\dash\face::title(T_("Edit Property"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/property?id='. \dash\request::get('id'));

	}
}
?>
