<?php
namespace content_a\category\editgroup;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit group title'));


		$id = \dash\request::get('id');

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/property?id='. $id);


		\content_a\category\property\view::load_property();
	}
}
?>