<?php
namespace content_site\section\html;


class controller
{
	public static function routing()
	{
		// load post detail
		// all url route in this module need page id
		\content_site\controller::load_current_page_detail();



		// // all section need to sid [section id] to load
		// $section_id = \dash\request::get('sid');
		// $section_id = \dash\validate::id($section_id);
		// if(!$section_id)
		// {
		// 	\dash\header::status(403, T_("Invalid section id"));
		// 	return;
		// }

		\dash\allow::html();

	}


}
?>