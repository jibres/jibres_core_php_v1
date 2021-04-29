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
		elseif(\dash\engine\content::get() === 'content_n')
		{
			$page_id = \dash\url::module();

			if($page_id && ($page_id = \dash\validate::code($page_id, false)))
			{
				// ok
			}
			else
			{
				return false;
			}
		}
		else
		{
			$page_id          = \lib\store::detail('homepage_builder_post_id');

			if($page_id)
			{
				$page_id = \dash\coding::encode($page_id);
			}

			$homepage_builder = true;

		}

		$args = [];

		$args['id'] = $page_id;
		$args['ready'] = true;


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