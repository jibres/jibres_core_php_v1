<?php
namespace content_site\section\html;


class view
{



	public static function config()
	{
		\content_site\view::fill_page_detail();

		\dash\data::include_adminPanelBuilder(true);

	}
}
?>