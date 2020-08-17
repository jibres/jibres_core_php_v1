<?php
namespace content_a\accounting\doc\duplicate;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Make copy from accounting document"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '/edit?id='. \dash\request::get('id'));
		\dash\data::newNumber(\lib\app\tax\doc\get::new_doc_number());

	}
}
?>
