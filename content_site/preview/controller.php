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

		$back_url = null;


		if(\dash\url::dir(3))
		{
			// preview/blog/b1/p1

			$back_url = \dash\url::that(). '/'. $type;

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
				$back_url = \dash\url::that();
				// preview/blog/b1
				// load section type preview list
				$preview_list = \content_site\call_function::preview_list($section, $type);
				\dash\data::previewSectionList($preview_list);
				$allow = true;

				\dash\data::myPreviewDisplayType('preview_list');
			}
			else
			{
				// preview/blog/b1
				// load section type list
				$section_list = \content_site\section\controller::section_list();

				$type_list = [];
				$group_list = [];

				foreach ($section_list as $key => $value)
				{
					if($section)
					{
						$back_url = \dash\url::this();
						if(a($value, 'key') === $section)
						{
							$section_requested_detail = \content_site\call_function::detail($value['key']);

							// $popular = \content_site\call_function::popular($value['key']);
							$type_list = \content_site\call_function::ready_type_list($value['key']);
						}
						else
						{
							// skip section by other key
							continue;
						}
					}
					else
					{
						// show all group
						if(!isset($group_list[a($value, 'group')]))
						{
							$group_list[a($value, 'group')] = [];
						}

						$group_list[a($value, 'group')][] = $value;
					}
				}

				if(\dash\url::child())
				{
					\dash\data::myPreviewDisplayType('type_list');
					\dash\data::myPreviewTypeList($type_list);
				}
				else
				{
					\dash\data::myPreviewDisplayType('group_list');
					\dash\data::groupSectionList($group_list);
				}

				$allow = true;
			}
		}

		if($allow)
		{
			\dash\data::previewBackUrl($back_url);
			\dash\temp::set('forceLoadNewSiteBuilder', true);
			\dash\data::demoOnlineLoadPreviewSection(true);
			\dash\open::get();
		}

	}
}
?>