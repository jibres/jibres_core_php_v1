<?php
namespace content_site\section\html;


class controller
{
	public static function routing()
	{
		// load post detail
		// all url route in this module need page id
		\content_site\controller::load_current_page_detail();


		if(\dash\request::get('sid'))
		{
			$section_id = \dash\request::get('sid');
			$section_id = \dash\validate::id($section_id);

			if(!$section_id)
			{
				\dash\notif::error(T_("Invalid section id"). ' '. __LINE__);
				return false;
			}

			\dash\data::mySectionID($section_id);
		}

		\dash\allow::html();

	}


}
?>