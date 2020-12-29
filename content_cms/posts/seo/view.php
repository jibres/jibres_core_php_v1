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

		$load_parent = \dash\app\posts\get::load_all_parent(\dash\request::get('id'));
		\dash\data::parentList($load_parent);


		if(\dash\data::dataRow_status() === 'publish')
		{
			\dash\data::postViewLink(\dash\data::dataRow_link());
			\dash\face::btnView(\dash\data::dataRow_link());
		}
		else
		{
			\dash\data::postViewLink(\dash\data::dataRow_link(). '?preview=yes');
			\dash\face::btnPreview(\dash\data::postViewLink());
		}


	}
}
?>