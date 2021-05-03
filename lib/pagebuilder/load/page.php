<?php
namespace lib\pagebuilder\load;


class page
{
	public static $is_page = false;

	public static $homepage_header_footer = [];

	public static function homepage_header_footer()
	{
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

		$homepage_builder = false;
		$load_by_template = false;
		$in_content_n     = false;


		// InBusinessHomeController

		// PageBuilderNeedlessToLoadBody


		// load a post by display of content_n
		if(\dash\engine\template::$finded_template)
		{
			if(\dash\data::dataRow_type() === 'pagebuilder')
			{
				// ok. load page builder
				$page_id = \dash\data::dataRow_id();

				$page_id = \dash\coding::decode($page_id);

				$load_by_template = true;
			}
			else
			{
				// need to load homepage header and footer
				return false;
			}
		}
		elseif(\dash\engine\content::is('n'))
		{
			$page_id = \dash\url::module();


			if($page_id && ($page_id = \dash\validate::code($page_id, false)))
			{
				$in_content_n = true;
				// ok
				$page_id = \dash\coding::decode($page_id);
			}
			else
			{
				// need to load homepage header and footer
				return false;
			}
		}
		else
		{
			$page_id          = \lib\pagebuilder\tools\homepage::id();

			$homepage_builder = true;

		}

		$args = [];


		$post_detail = \lib\pagebuilder\tools\current_post::load($page_id);

		if(!$post_detail)
		{
			return false;
		}

		// not route special post url when the post set as homepage
		if(!$homepage_builder && a($post_detail, 'ishomepage'))
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		$need_load_body = true;


		if(isset($post_detail['meta']['template']) && $homepage_builder)
		{
			if(in_array($post_detail['meta']['template'], ['comingsoon', 'visitcard']))
			{
				\dash\temp::set('pagebuilder_template', $post_detail['meta']['template']);

				switch ($post_detail['meta']['template'])
				{
					case 'comingsoon':
						\dash\face::disablePWA_Header(true);
						\dash\face::css(["business/comingsoon-1/comingsoon-1.css"]);
						break;

					case 'visitcard':
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

				$need_load_body = false;
			}
		}


		$list = [];

		if($need_load_body && $page_id && is_numeric($page_id))
		{
			$list = \lib\db\pagebuilder\get::line_list($page_id);
		}

		$result                = [];

		$result['post_detail'] = $post_detail;

		self::ready($result, $list);

		if(!$result)
		{
			return false;
		}

		self::$is_page = true;


		return $result;
	}



	private static function ready(&$result, $list)
	{
		$result['header'] = [];
		$result['body']   = [];
		$result['footer'] = [];

		foreach ($list as $key => $value)
		{
			if(isset($value['mode']) && isset($value['type']) && is_string($value['type']))
			{
				if(in_array($value['mode'], ['header', 'footer', 'body']))
				{
					$result[$value['mode']][] = \lib\pagebuilder\tools\tools::global_ready_show($value['mode'], $value['type'], $value);
				}
			}
		}
	}
}
?>