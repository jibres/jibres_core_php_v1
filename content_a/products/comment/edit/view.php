<?php
namespace content_a\products\comment\edit;

class view
{
	public static function config()
	{
		$id = \dash\request::get('cid');

		$detail = \lib\app\product\comment::get($id);
		if(!$detail)
		{
			\dash\header::status(404, T_("Invalid id"));
		}

		\dash\data::dataRow($detail);

		\dash\face::title(T_("Edit comment"));

		\dash\data::back_link(\dash\url::this(). '/comment?id='. \dash\request::get('id'));
		\dash\data::back_text(T_('Back'));


	}
}
?>