<?php
namespace content_cms\comments\edit;

class view
{
	public static function config()
	{

		\dash\face::title(T_("Edit comment"));

		\dash\data::back_link(\dash\data::viewCommentModule(). \dash\request::full_get());
		\dash\data::back_text(T_('Back'));

	}
}
?>