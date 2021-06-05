<?php
namespace lib\sitebuilder;


class get
{
	// load once
	private static $load_page_detail_once = [];

	/**
	 * Loads a current page detail.
	 *
	 * @param      <type>  $_id    The identifier
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function load_page_detail($_page_id)
	{
		$page_id = \dash\coding::decode($_page_id);
		if(!$page_id)
		{
			return false;
		}

		if(isset(self::$load_page_detail_once[$page_id]))
		{
			return self::$load_page_detail_once[$page_id];
		}

		$post_detail = \dash\db\posts\get::by_id_type($page_id, 'pagebuilder');

		if(!$post_detail)
		{
			return false;
		}

		$ready = \dash\app\posts\ready::row($post_detail);

		self::$load_page_detail_once[$page_id] = $ready;

		return $ready;
	}



	public static function body_section_list($_page_id)
	{
		$page_id = \dash\coding::decode($_page_id);

		if(!$page_id)
		{
			return false;
		}

		$section_list = \lib\db\pagebuilder\get::line_list($page_id);

		if(!is_array($section_list))
		{
			$section_list = [];
		}

		$section_list = array_map(['\\lib\\sitebuilder\\ready', 'section_list'], $section_list);

		return $section_list;

	}


	public static function body_section_detail($_page_id, $_section_id, $_valid_section_key)
	{
		$page_id = \dash\coding::decode($_page_id);

		if(!$page_id)
		{
			return false;
		}

		$section_detail = \lib\db\pagebuilder\get::by_id_related_id($_section_id, $page_id);

		if(!is_array($section_detail) || !$section_detail)
		{
			return false;
		}

		$section_detail = \lib\sitebuilder\ready::section_list($section_detail);

		if(isset($section_detail['preview']['key']) && $section_detail['preview']['key'] === $_valid_section_key)
		{
			// ok
		}
		else
		{
			return false;
		}

		return $section_detail;

	}
}
?>