<?php
namespace content_site\load;


class load
{
	public static $is_page = false;

	public static $homepage_header_footer = [];


	public static function homepage_header_footer()
	{
		if(!empty(self::$homepage_header_footer))
		{
			return self::$homepage_header_footer;
		}

		$homepage_header_footer = \content_site\homepage::get_header_and_footer();

		$result = [];

		self::ready($result, $homepage_header_footer);

		unset($result['body']);

		self::$homepage_header_footer = $result;

		return $result;

	}


	public static function get_page_detail($_id)
	{
		if($_id && is_numeric($_id))
		{
			// ok
		}
		else
		{
			return false;
		}
		// load post detail
		$post_detail = \dash\db\posts\get::by_id_type($_id, 'pagebuilder');

		$is_homepage = false;

		if(isset($post_detail['id']) && floatval($post_detail['id']) === floatval(\content_site\homepage::id()))
		{
			$post_detail['ishomepage'] = true;
			$is_homepage               = true;
		}

		\dash\temp::set('not_load_cms_setting', true);

		$ready = \dash\app\posts\ready::row($post_detail);

		if(self::load_preview_mode($post_detail))
		{
			$my_page_setting = a($ready, 'meta', 'preview');
		}
		else
		{
			$my_page_setting = a($ready, 'meta', 'body');
		}

		if(a($my_page_setting, 'font'))
		{
			$page_font = \content_site\assemble\font::class($my_page_setting);
			\dash\data::bodyMasterFont($page_font);
		}

		if(a($my_page_setting, 'background_pack'))
		{
			$background_style = \content_site\assemble\background::style($my_page_setting);
			\dash\data::bodyBackgroundStyle($background_style);
		}


		$temp = $ready;
		if($is_homepage)
		{
			\dash\face::specialTitle(true);
			unset($temp['post_title']);
			unset($temp['title']);
		}
		// fill dataRow to set cms title
		$force_remove_dataRow = false;

		if(!\dash\data::dataRow())
		{
			$force_remove_dataRow = true;

			\dash\data::dataRow($temp);
		}


		\dash\engine\view::set_cms_titles();

		if($force_remove_dataRow)
		{
			\dash\data::dataRow(null);
		}

		return $ready;
	}


	/**
	 * Loads a preview mode.
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	private static function load_preview_mode($_post_detail)
	{
		// check load preview mode
		if(\dash\request::get('preview') && a($_post_detail, 'datecreated') && \dash\request::get('preview') === md5($_post_detail['datecreated']))
		{
			return true;
		}

		return false;
	}


	/**
	 * Exception module
	 * Needless to load pagebuilder
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	private static function exception_module()
	{
		// app is not pagebuilder
		if(\dash\engine\content::is('business') && \dash\url::module() === 'app')
		{
			return true;
		}

		return false;
	}


	public static function current_page()
	{
		// exception module needless to load pagebuilder
		if(self::exception_module())
		{
			return false;
		}


		$page_id                             = null;
		$post_detail                         = null;
		$homepage_builder                    = false;
		$need_homepage_header_footer         = false;
		$need_explode_homepage_header_footer = false;

		$homepage_id                  = \content_site\homepage::id();



		// load a post by display of content_n
		if(\dash\engine\template::$finded_template)
		{
			if(\dash\data::dataRow_type() === 'pagebuilder')
			{
				// ok. load page builder
				$page_id = \dash\data::dataRow_id();

				$page_id = \dash\coding::decode($page_id);

			}
			else
			{
				$need_homepage_header_footer = true;
			}
		}
		elseif(\dash\temp::get('inContentNHomeController'))
		{
			$page_id = \dash\url::child();

			// ok
			$page_id = \dash\coding::decode($page_id);

			$ThePostLoadedInContentN = \dash\temp::get('ThePostLoadedInContentN');

			if(isset($ThePostLoadedInContentN['type']) && $ThePostLoadedInContentN['type'] === 'pagebuilder')
			{
				// needless to load homepage
			}
			else
			{
				$need_homepage_header_footer = true;
			}
		}
		elseif(\dash\temp::get('InBusinessHomeController'))
		{
			$page_id                     = $homepage_id;

			$homepage_builder          = true;

			$need_homepage_header_footer = true;
		}
		else
		{
			$need_homepage_header_footer = true;
		}

		if(!$page_id || !is_numeric($page_id))
		{
			if($homepage_id)
			{
				$post_detail = self::get_page_detail($homepage_id);
			}

			if($need_homepage_header_footer)
			{
				// load homepage header and footer only
				self::homepage_header_footer();
			}

			// only need homepage header and footer
			return false;
		}
		else
		{
			$post_detail = self::get_page_detail($page_id);
		}

		if(!$post_detail)
		{
			// post not founded !!!
			return false;
		}

		// not route special post url when the post set as homepage
		if(!$homepage_builder && a($post_detail, 'ishomepage'))
		{
			$url = \dash\url::kingdom(). '/';
			$url .= \dash\request::full_get();
			\dash\redirect::to($url);
		}


		$list = [];

		if($homepage_builder || floatval($page_id) === floatval($homepage_id))
		{
			if(self::load_preview_mode($post_detail))
			{
				$list = \lib\db\sitebuilder\get::line_list_preview($page_id);
			}
			else
			{
				// in homepage need to load full homepage detail
				$list = \lib\db\sitebuilder\get::line_list($page_id);
			}
		}
		else
		{
			if(self::load_preview_mode($post_detail))
			{
				$list = \lib\db\sitebuilder\get::line_list_with_homepage_header_footer_preview($page_id, $homepage_id);
			}
			else
			{
				// load full page id and homepage header and footer
				$list = \lib\db\sitebuilder\get::line_list_with_homepage_header_footer($page_id, $homepage_id);
			}
			$need_explode_homepage_header_footer = true;
		}



		$result                = [];

		$result['post_detail'] = $post_detail;

		\dash\data::currentPageDetail($post_detail);

		if(isset($post_detail['meta']['template']))
		{
			$result['template'] = $post_detail['meta']['template'];
		}
		else
		{
			$result['template'] = 'publish';
		}

		self::ready($result, $list, $need_explode_homepage_header_footer, $homepage_id);

		if(empty(array_merge($result['header'], $result['body'], $result['footer'])))
		{
			\dash\data::emptySectionList(true);
		}

		self::$is_page = true;

		return $result;
	}


	private static function ready(&$result, $list, $need_explode_homepage_header_footer = null, $homepage_id = null)
	{
		$result['header']      = [];
		$result['body']        = [];
		$result['footer']      = [];

		if(!is_array($list))
		{
			$list = [];
		}

		$section_counter = 0;

		foreach ($list as $key => $value)
		{
			if(isset($value['folder']) && isset($value['section']) && is_string($value['section']))
			{
				if(!in_array($value['folder'], ['header', 'footer', 'body']))
				{
					continue;
				}

				if($value['folder'] === 'body')
				{
					$section_counter++;
				}

				$section_option =
				[
					'section_counter' => $section_counter,
				];

				if($need_explode_homepage_header_footer)
				{
					if(floatval(a($value, 'related_id')) === floatval($homepage_id))
					{
						self::$homepage_header_footer[$value['folder']][] = \content_site\section\view::ready_section_list($value, true, $section_option);
						continue;
					}
				}

				$result[$value['folder']][] = \content_site\section\view::ready_section_list($value, true, $section_option);
			}
		}

		$new_body = [];

		foreach ($result['body'] as $key => $value)
		{
			if(\content_site\assemble\device::is_ok($value))
			{
				$new_body[] = $value;
			}
		}

		$result['body'] = $new_body;

	}



	public static function detect_header()
	{
		// exception module needless to load pagebuilder
		if(self::exception_module())
		{
			return false;
		}


		$currentHeader = [];

		$current_module_header = \dash\data::website_header();

		if(is_array($current_module_header) && $current_module_header)
		{
			$currentHeader = $current_module_header;
		}
		elseif(isset(self::$homepage_header_footer['header']))
		{
			$currentHeader = self::$homepage_header_footer['header'];
		}

		if(isset($currentHeader[0]))
		{
			$currentHeader = $currentHeader[0];
		}


		\dash\data::website_header($currentHeader);

		return $currentHeader;

	}



	public static function detect_footer()
	{
		// exception module needless to load pagebuilder
		if(self::exception_module())
		{
			return false;
		}

		$currentFooter = [];

		$current_module_footer = \dash\data::website_footer();

		if(is_array($current_module_footer) && $current_module_footer)
		{
			$currentFooter = $current_module_footer;
		}
		elseif(isset(self::$homepage_header_footer['footer']))
		{
			$currentFooter = self::$homepage_header_footer['footer'];
		}

		if(isset($currentFooter[0]))
		{
			$currentFooter = $currentFooter[0];
		}

		\dash\data::website_footer($currentFooter);

		return $currentFooter;

	}

}
?>