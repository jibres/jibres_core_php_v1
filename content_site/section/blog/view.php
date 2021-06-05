<?php
namespace content_site\section\blog;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Blog post'));

		\content_site\section\view::default_view_config();
	}

}
?>