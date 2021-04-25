<?php
namespace lib\pagebuilder\load;


class page
{
	public static $is_page = false;

	public static function current_page()
	{
		// only check page builder in business content and content_n
		if(\dash\engine\content::get() !== 'content_business' && \dash\engine\content::get() !== 'content_n')
		{
			return false;
		}

		$homepage_builder = false;


		// if(!\dash\temp::get('inHomePageOfBusiness'))
		// {
		// 	// in homepage
		// }

		// load a post by display of content_n
		if(\dash\engine\template::$finded_template)
		{
			if(\dash\data::dataRow_type() === 'pagebuilder')
			{
				// ok. load page builder
				$page_id = \dash\data::dataRow_id();
			}
			else
			{
				return false;
			}
		}
		else
		{
			$page_id          = null;
			$homepage_builder = true;
		}

		$args = [];

		$args['id'] = $page_id;

		$check_current_page = \lib\pagebuilder\tools\search::list($args);


		if(!$check_current_page)
		{
			return false;
		}

		self::$is_page = true;

		return $check_current_page;
	}
}
?>