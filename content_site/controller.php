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



	/**
	 * Get page id
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
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
	 * Load a current page detail.
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



	/**
	 * Load current section list.
	 *
	 * @param      <type>  $_mode  The mode
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function load_current_section_list($_mode = null)
	{
		$page_id = self::page_id();

		$section_list = \lib\sitebuilder\get::body_section_list($page_id, $_mode);

		\dash\data::currentSectionList($section_list);

		return $section_list;

	}



	/**
	 * Load current section detail.
	 *
	 * @param      <type>  $_valid_section_key  The valid section key
	 * @param      array   $_options_list       The options list
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function load_current_section_detail($_valid_section_key, $_options_list = [])
	{
		$sid = \dash\request::get('sid');
		$sid = \dash\validate::id($sid);
		if(!$sid)
		{
			\dash\header::status(404, T_("Invalid section id"));
		}

		$page_id = self::page_id();


		$section_detail = \lib\sitebuilder\get::body_section_detail($page_id, $sid, $_valid_section_key, $_options_list);

		if(!$section_detail)
		{
			\dash\header::status(404, T_("Invalid section detail"));
		}

		\dash\data::currentSectionDetail($section_detail);

		return $section_detail;

	}
}
?>
