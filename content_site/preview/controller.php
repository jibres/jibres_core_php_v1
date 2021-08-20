<?php
namespace content_site\preview;


class controller
{
	public static function routing()
	{
		$section = \dash\url::child();
		$type    = \dash\url::subchild();
		$preview = \dash\url::dir(3);


		if(\dash\url::dir(4))
		{
			\dash\header::status(404);
		}

		$section = \dash\validate::string_100($section);
		$type    = \dash\validate::string_100($type);
		$preview = \dash\validate::string_100($preview);



		if(!$section || !$type || !$preview)
		{
			\dash\header::status(404, T_("Invalid section name or preview key"));
			return false;
		}


		$result = \content_site\call_function::generate_preview($section, $type, $preview);
		if(!$result)
		{
			\dash\header::status(404, T_("Invalid preview detail"));
			return false;
		}

		\dash\data::myPreviewDetail($result);

		\dash\open::get();

		return true;
	}


	public static function demo_router()
	{
			// load preview section in demo website
		$in_demo_website = \dash\url::subdomain() === 'demo';
		if(!$in_demo_website)
		{
			return;
		}

		if(\dash\url::module() !== 'preview')
		{
			return;
		}

		$section = \dash\url::child();
		$type    = \dash\url::subchild();
		$preview = \dash\url::dir(3);


		if(\dash\url::dir(4))
		{
			\dash\header::status(404);
		}

		$section = \dash\validate::string_100($section);
		$type    = \dash\validate::string_100($type);
		$preview = \dash\validate::string_100($preview);

		$allow = false;


		if(\dash\url::dir(3))
		{
			// preview/blog/b1/p1

			$load_preview = self::routing();
			if($load_preview)
			{
				\dash\data::myPreviewDisplayType('preview_html');
				$allow = true;
			}
		}
		else
		{
			if(\dash\url::subchild())
			{
				$preview_list = \content_site\call_function::preview_list($section);
				\dash\data::previewSectionList($preview_list);
				$allow = true;

				\dash\data::myPreviewDisplayType('preview_list');
				// preview/blog/b1
				// load section type preview list
			}
			else
			{
				// preview/blog/b1
				// load section type list
			}
		}

		if($allow)
		{
			\dash\temp::set('forceLoadNewSiteBuilder', true);
			\dash\data::demoOnlineLoadPreviewSection(true);
			\dash\open::get();
		}

	}
}
?>