<?php
namespace content_site\section\blog;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Blog post'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/site'. \dash\request::full_get(['sid' => null]));


	}

}
?>