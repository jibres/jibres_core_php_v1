<?php
namespace content_a\products\comment\view;

class view extends \content_cms\comments\view\view
{
	public static function config()
	{
		parent::config();

		$id = \dash\request::get('cid');

		\dash\data::back_link(\dash\url::this(). '/comment?id='. \dash\request::get('id'));
		\dash\data::back_text(T_('Back'));


	}
}
?>