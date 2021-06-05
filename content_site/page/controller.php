<?php
namespace content_site\page;


class controller
{
	public static function routing()
	{
		\content_site\controller::load_current_page_detail();
		\content_site\controller::load_current_section_list();
	}
}
?>