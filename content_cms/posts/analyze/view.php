<?php
namespace content_cms\posts\analyze;

class view
{
	public static function config()
	{
		\dash\face::title(T_("SEO Content Analysis"));

		\dash\data::back_text(T_("Back"));
		\dash\data::back_link(\dash\url::this(). '/edit'. \dash\request::full_get());

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

		$dataRow = \dash\data::dataRow();
		$seo_detail            = [];
		$seo_detail['type']    = 'post';
		$seo_detail['id']      = a($dataRow, 'id');
		$seo_detail['title']   = a($dataRow, 'post_title');
		$seo_detail['seodesc'] = a($dataRow, 'excerpt');
		$seo_detail['content'] = a($dataRow, 'content');
		$seo_detail['tags']    = a($dataRow, 'tags');

		$seoAnalyze    = \dash\seo::analyze($seo_detail);

		\dash\data::seoAnalyze($seoAnalyze);
	}
}
?>