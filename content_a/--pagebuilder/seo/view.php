<?php
namespace content_a\pagebuilder\seo;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Customize SEO'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/manage'. \dash\request::full_get());

		\dash\face::btnSave('editFormSEO');

		$load_line = \lib\pagebuilder\tools\get::current_line_list();
		\dash\data::lineList($load_line);

		$dataRow = a(\dash\data::lineList(), 'post_detail');

		\dash\data::dataRow($dataRow);

		if(a($dataRow, 'status') === 'publish')
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