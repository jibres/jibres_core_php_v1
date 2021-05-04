<?php
namespace lib\pagebuilder\load;


class page
{
	public static $is_page = false;

	public static $homepage_header_footer = [];

	public static function homepage_header_footer()
	{
		if(!empty(self::$homepage_header_footer))
		{
			return self::$homepage_header_footer;
		}

		$homepage_header_footer = \lib\pagebuilder\tools\homepage::get_header_and_footer();

		$result = [];

		self::ready($result, $homepage_header_footer);

		unset($result['body']);

		self::$homepage_header_footer = $result;

		return $result;

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

		$homepage_id                  = \lib\pagebuilder\tools\homepage::id();



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
		elseif(\dash\engine\content::is('n') && \dash\temp::get('inContentNHomeController'))
		{
			$page_id = \dash\url::module();

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
			$post_detail = \lib\pagebuilder\tools\current_post::load($page_id);
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
				\dash\temp::set('pagebuilder_template', $post_detail['meta']['template']);

				switch ($post_detail['meta']['template'])
				{
					case 'comingsoon':
						$comingsoon_visitcad_template = true;
						\dash\face::disablePWA_Header(true);
						\dash\face::css(["business/comingsoon-1/comingsoon-1.css"]);
						break;

					case 'visitcard':
						$comingsoon_visitcad_template = true;
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
					// load full page id and homepage header and footer
					$list = \lib\db\pagebuilder\get::line_list_with_homepage_header_footer($page_id, $homepage_id);
					$need_explode_homepage_header_footer = true;
				}
			}

		}

		$result                = [];

		$result['post_detail'] = $post_detail;

		self::ready($result, $list, $need_explode_homepage_header_footer, $homepage_id);

		self::$is_page = true;

		return $result;
	}


	private static function ready(&$result, $list, $need_explode_homepage_header_footer = null, $homepage_id = null)
	{
		$result['header']      = [];
		$result['body']        = [];
		$result['footer']      = [];

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
						self::$homepage_header_footer[$value['mode']][] = \lib\pagebuilder\tools\tools::global_ready_show($value['mode'], $value['type'], $value);
						continue;
					}
				}

				$result[$value['mode']][] = \lib\pagebuilder\tools\tools::global_ready_show($value['mode'], $value['type'], $value);

			}
		}
	}



	public static function detect_header()
	{
		$currentHeader = [];

		if(isset(self::$homepage_header_footer['header']))
		{
			$currentHeader = self::$homepage_header_footer['header'];
		}
		else
		{
			$current_module_header = \dash\data::website_header();

			if(is_array($current_module_header))
			{
				$currentHeader = $current_module_header;
			}
		}

		// detect header
		if(isset($currentHeader[0]))
		{
			$currentHeader = $currentHeader[0];
		}

		// load heade
		if(!empty($website_header))
		{
			foreach ($website_header as $key => $value)
			{
				$header_addr = root. 'lib/pagebuilder/header/'. $value['type']. '/website.php';
				if(is_file($header_addr))
				{
					require_once($header_addr);
				}
			}
		}
	}



}
?>