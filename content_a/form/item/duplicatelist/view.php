<?php
namespace content_a\form\item\duplicatelist;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage duplicate list'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/item?'. \dash\request::fix_get());


	}
}
?>
