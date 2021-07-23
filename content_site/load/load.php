<?php
namespace content_site\load;


class load
{
	public static $is_page = false;

	public static $homepage_header_footer = [];

	public static $comingsoon_visitcad_template = false;


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

		if(isset($post_detail['id']) && floatval($post_detail['id']) === floatval(\content_site\homepage::id()))
		{
			$post_detail['ishomepage'] = true;
		}

		\dash\temp::set('not_load_cms_setting', true);

		$ready = \dash\app\posts\ready::row($post_detail);

		return $ready;
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
		$need_homepage_body                  = false;
		$need_homepage_header_footer         = false;
		$comingsoon_visitcad_template        = false;
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

			$homepage_builder            = true;

			$need_homepage_body          = true;

			$need_homepage_header_footer = true;
		}
		else
		{
			$need_homepage_header_footer = true;
		}

		if(!$page_id || !is_numeric($page_id))
		{
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
			\dash\redirect::to(\dash\url::kingdom());
		}


		if(isset($post_detail['meta']['template']) && $homepage_builder)
		{
			if(in_array($post_detail['meta']['template'], ['comingsoon', 'visitcard']))
			{
				switch ($post_detail['meta']['template'])
				{
					case 'comingsoon':
						$comingsoon_visitcad_template = 'comingsoon';
						\dash\face::disablePWA_Header(true);
						\dash\face::css(["business/comingsoon-1/comingsoon-1.css"]);
						break;

					case 'visitcard':
						$comingsoon_visitcad_template = 'visitcard';
						\dash\face::disablePWA_Header(true);
						\dash\face::css(
							[
								"business/visitcard-1/visitcard-1.css",
								"https://fonts.googleapis.com/css?family=Quicksand:300,400"
							]
						);
						\dash\face::twitterCard('summary_large_image');
						break;

					default:
						break;
				}
			}
		}

		$list = [];

		if($comingsoon_visitcad_template)
		{
			self::$comingsoon_visitcad_template = $comingsoon_visitcad_template;
			// nothing !
		}
		else
		{
			if($need_homepage_body)
			{
				// in homepage need to load full homepage detail
				$list = \lib\db\pagebuilder\get::line_list($page_id);
			}
			else
			{
				if(floatval($page_id) === floatval($homepage_id))
				{
					// homepage id is equal with page id. load full page id detail
					$list = \lib\db\pagebuilder\get::line_list($page_id);
				}
				else
				{

					if(\dash\request::get('preview') && a($post_detail, 'datecreated') && \dash\request::get('preview') === md5($post_detail['datecreated']))
					{
						$list = \lib\db\pagebuilder\get::line_list_with_homepage_header_footer_preview($page_id, $homepage_id);
					}
					else
					{
						// load full page id and homepage header and footer
						$list = \lib\db\pagebuilder\get::line_list_with_homepage_header_footer($page_id, $homepage_id);
					}
					$need_explode_homepage_header_footer = true;
				}
			}

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

		foreach ($list as $key => $value)
		{
			if(isset($value['mode']) && isset($value['type']) && is_string($value['type']))
			{
				if(!in_array($value['mode'], ['header', 'footer', 'body']))
				{
					continue;
				}

				if($need_explode_homepage_header_footer)
				{
					if(floatval(a($value, 'related_id')) === floatval($homepage_id))
					{
						self::$homepage_header_footer[$value['mode']][] = \content_site\section\view::ready_section_list($value, true);
						continue;
					}
				}

				$result[$value['mode']][] = \content_site\section\view::ready_section_list($value, true);

			}
		}

		$new_body = [];

		foreach ($result['body'] as $key => $value)
		{
			if(\lib\pagebuilder\body\device\device::is_ok(a($value, 'device'), a($value, 'mobile'), a($value, 'os')))
			{
				$new_body[] = $value;
			}
		}

		$result['body'] = $new_body;

	}



	// public static function detect_header()
	// {
	// 	// exception module needless to load pagebuilder
	// 	if(self::exception_module())
	// 	{
	// 		return false;
	// 	}

	// 	if(self::$comingsoon_visitcad_template)
	// 	{
	// 		return false;
	// 	}

	// 	$currentHeader = [];

	// 	$current_module_header = \dash\data::website_header();

	// 	if(is_array($current_module_header) && $current_module_header)
	// 	{
	// 		$currentHeader = $current_module_header;
	// 	}
	// 	elseif(isset(self::$homepage_header_footer['header']))
	// 	{
	// 		$currentHeader = self::$homepage_header_footer['header'];
	// 	}

	// 	// detect header
	// 	if(isset($currentHeader[0]))
	// 	{
	// 		$currentHeader = $currentHeader[0];
	// 	}


	// 	\dash\data::currentHeader($currentHeader);

	// 	return $currentHeader;

	// }



	// public static function detect_footer()
	// {
	// 	// exception module needless to load pagebuilder
	// 	if(self::exception_module())
	// 	{
	// 		return false;
	// 	}

	// 	if(self::$comingsoon_visitcad_template)
	// 	{
	// 		return false;
	// 	}

	// 	$currentFooter = [];

	// 	$current_module_footer = \dash\data::website_footer();

	// 	if(is_array($current_module_footer) && $current_module_footer)
	// 	{
	// 		$currentFooter = $current_module_footer;
	// 	}
	// 	elseif(isset(self::$homepage_header_footer['footer']))
	// 	{
	// 		$currentFooter = self::$homepage_header_footer['footer'];
	// 	}
	// 	// detect footer
	// 	if(isset($currentFooter[0]))
	// 	{
	// 		$currentFooter = $currentFooter[0];
	// 	}


	// 	\dash\data::currentFooter($currentFooter);

	// 	return $currentFooter;

	// }

}
?>