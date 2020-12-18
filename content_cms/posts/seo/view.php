<?php
namespace content_cms\posts\seo;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit post SEO"));

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link(\dash\url::this(). '/edit'. \dash\request::full_get());

		\dash\face::btnSave('editFormSEO');

		$dataRow = \dash\data::dataRow();
		if(a($dataRow, 'type') === 'page' || a($dataRow, 'type') === 'help')
		{
			$load_parent = \dash\app\posts\get::load_all_parent(\dash\request::get('id'));
			\dash\data::parentList($load_parent);
		}

	}
}
?>