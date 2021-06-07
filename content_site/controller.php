<?php
namespace content_site;


class controller
{

	// load page detail once
	private static $load_page_detail_once = [];


	/**
	 * Maste content controller
	 */
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
	 * Load a current page detail.
	 * Check have id and this is is valid and load post detail
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function load_current_page_detail()
	{
		$page_id = \dash\validate::code(\dash\request::get('id'));

		$page_id = \dash\coding::decode($page_id);

		if(!$page_id)
		{
			\dash\header::status(404, T_("Invalid page id"));
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

		$load = \dash\app\posts\ready::row($post_detail);

		self::$load_page_detail_once[$page_id] = $load;

		\dash\data::currentPageDetail($load);

		return $load;

	}


	public static function load_current_section_list($_mode = null)
	{
		$page_id = \dash\coding::decode(\dash\request::get('id'));

		if(!$page_id)
		{
			return false;
		}

		$section_list = \lib\db\pagebuilder\get::line_list($page_id);

		if(!is_array($section_list))
		{
			$section_list = [];
		}

		$section_list = array_map(['\\content_site\\section\\view', 'ready_section_list'], $section_list);

		if($_mode !== 'with_adding')
		{
			$new_list = [];
			foreach ($section_list as $key => $value)
			{
				if(isset($value['preview']['adding']))
				{
					// nothing
				}
				else
				{
					$new_list[] = $value;
				}
			}

			$section_list = $new_list;
		}

		\dash\data::currentSectionList($section_list);

		return $section_list;

	}
}
?>
