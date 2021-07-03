<?php
namespace content_site;


class view
{
	public static function config()
	{
		\dash\face::site(T_("Jibres"));
		\dash\face::intro(T_("Jibres is not just an online accounting software;"). ' '.  T_("We try to create the best financial platform that has everything you need to sale and manage your financial life."));
		\dash\face::slogan(T_("Integrated Sales and Online Accounting"));


		switch (\dash\url::directory())
		{
			case null:
			case 'page/new':
				\dash\data::include_adminPanelBuilder(true);
				// code...
				break;

			default:
				// show display inside sidebar and iframe in page center
				\dash\data::include_adminPanelBuilder("siteLivePreview");
				break;
		}


		\dash\face::site(\lib\store::title());
		\dash\data::store(\lib\store::detail());
		\dash\face::logo(\lib\store::logo());

		// set shortkey for all badges is this content
		\dash\data::badge_shortkey(120);


		\dash\upload\size::set_default_file_size();
	}


	/**
	 * Set page tilte
	 * set page url to show in iframe
	 */
	public static function fill_page_detail()
	{
		\dash\face::title(T_('Page'));
		if(\dash\data::currentPageDetail_title())
		{
			\dash\face::title(\dash\data::currentPageDetail_title());
		}

		\dash\data::btnSaveSiteBuilder(true);

		$link = \dash\data::currentPageDetail_link();

		if(\dash\data::currentPageDetail_status() !== 'publish')
		{
			$link .= '?preview=yes';
		}
		\dash\data::btnPreviewSiteBuilder($link);
	}

}
?>