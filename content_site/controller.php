<?php
namespace content_site;


class controller
{
	public static function routing()
	{
		if(!\dash\url::store())
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		if(!\lib\store::id())
		{
			\dash\header::status(404, T_("Store not found"));
		}

		// check user is login
		\dash\redirect::to_login();


		if(!\dash\permission::has_permission())
		{
			\dash\permission::deny();
		}
	}


	private static function page_id()
	{
		$page_id = \dash\request::get('id');

		$page_id = \dash\validate::code($page_id);

		if(!$page_id)
		{
			\dash\header::status(404, T_("Invalid page id"));
		}

		return $page_id;
	}


	/**
	 * Loads a current page detail.
	 * Check have id and this is is valid and load post detail
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function load_current_page_detail()
	{
		$page_id = self::page_id();

		$load = \lib\sitebuilder\get::load_page_detail($page_id);

		if(!$load)
		{
			\dash\header::status(404, T_("Page detail not found"));
		}

		\dash\data::currentPageDetail($load);

		return $load;

	}


	public static function load_current_section_list()
	{
		$page_id = self::page_id();

		$section_list = \lib\sitebuilder\get::body_section_list($page_id);

		\dash\data::currentSectionList($section_list);

		return $section_list;

	}


	public static function load_current_section_detail($_valid_section_key)
	{
		$sid = \dash\request::get('sid');
		$sid = \dash\validate::id($sid);
		if(!$sid)
		{
			\dash\header::status(404, T_("Invalid section id"));
		}

		$page_id = self::page_id();


		$section_detail = \lib\sitebuilder\get::body_section_detail($page_id, $sid, $_valid_section_key);

		if(!$section_detail)
		{
			\dash\header::status(404, T_("Invalid section detail"));
		}

		\dash\data::currentSectionDetail($section_detail);

		return $section_detail;

	}
}
?>
