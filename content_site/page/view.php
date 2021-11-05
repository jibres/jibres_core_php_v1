<?php
namespace content_site\page;


class view
{
	public static function config()
	{

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\content_site\view::fill_page_detail();


		// auto check and save page after payment
		if(\dash\request::get('auto') === 'save')
		{
			model::save_page();
		}

		// detect siteBuilder to use titleBox inside haeder
		\dash\data::include_m2('siteBuilder');

		// show display inside sidebar and iframe in page center
		\dash\data::include_adminPanelBuilder("siteLivePreview");

	}
}
?>