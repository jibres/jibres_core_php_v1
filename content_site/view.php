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

		\dash\data::pageBuilderIframeSize(\content_site\utility::set_iframe_on());
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

		if(\dash\data::currentSectionDetail())
		{
			$currentSectionDetail = \dash\data::currentSectionDetail();

			$myTitle = ' [ '. a($currentSectionDetail, 'model'). ' ]';

			\dash\face::title(\dash\face::title(). ' '. $myTitle);
		}

		\dash\data::btnSaveSiteBuilder(true);

		self::generate_iframe_src();
	}


	public static function generate_iframe_src($_include_time = false)
	{
		$link = \dash\data::currentPageDetail_link();


		if(\dash\url::isLocal())
		{
			$link = \lib\store::subdomain_url(). '/';
			$link .= \dash\data::currentPageDetail_linkpath();
		}

		if(\dash\request::get('id') === homepage::code())
		{
			if(\dash\url::isLocal())
			{
				$link = \lib\store::subdomain_url();
			}
			else
			{
				$link = \lib\store::url();
			}
		}

		$get = [];

		// if(\dash\data::currentPageDetail_status() !== 'publish')
		// {
		// 	$get['preview'] = 'yes';
		// }
		$referer = \dash\server::referer();
		if($_include_time || strpos($referer, 'gallery/image_list') !== false)
		{
			$get['time'] = time();
		}

		$get['preview'] = md5(\dash\data::currentPageDetail_datecreated());

		\dash\data::btnPreviewSiteBuilderOneSection($link. '?'. \dash\request::build_query(array_unique(array_merge($get, ['psid' => \dash\request::get('sid')]))));

		$link .= '?'. \dash\request::build_query($get);

		$id = a(\dash\data::currentSectionDetail(), 'model'). '-'. a(\dash\data::currentSectionDetail(), 'id');
		$link .= '#'. $id;


		\dash\data::btnPreviewSiteBuilder($link);

		return $link;
	}

}
?>