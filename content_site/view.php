<?php
namespace content_site;


class view
{
	public static function config()
	{
		\dash\face::site(T_("Jibres"));
		\dash\face::intro(T_("Jibres is not just an online accounting software;"). ' '.  T_("We try to create the best financial platform that has everything you need to sale and manage your financial life."));
		\dash\face::slogan(T_("Integrated Sales and Online Accounting"));


		\dash\data::include_m2(true);
		\dash\data::include_m2_search(\dash\url::kingdom(). '/a/setting/search/full');
		\dash\data::include_m2_searchPlaceHolder(T_('Search'));

		\dash\face::site(\lib\store::title());
		\dash\data::store(\lib\store::detail());
		\dash\face::logo(\lib\store::logo());

		// set shortkey for all badges is this content
		\dash\data::badge_shortkey(120);


		\dash\upload\size::set_default_file_size();

		\dash\data::pageBuilderIframeSize(\content_site\utility::set_iframe_on());

		\dash\data::global_scriptPage('a_site_builder.js');
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

		// if(\dash\data::currentSectionDetail())
		// {
		// 	$currentSectionDetail = \dash\data::currentSectionDetail();
		// 	$myTitle = ' [ '. implode(':', [ a($currentSectionDetail, 'section'), a($currentSectionDetail, 'model'), a($currentSectionDetail, 'preview_key')]). ' ]';
		// 	\dash\face::title(\dash\face::title(). ' '. $myTitle);
		// }

		if(\dash\url::subchild())
		{
			$special_title = null;

			switch (\dash\url::subchild())
			{
				case 'style':
					$special_title = T_("Style");
					break;

				case 'spacing':
					$special_title = T_("Spacing");
					break;

				case 'responsive':
					$special_title = T_("Responsive");
					break;

				default:
					break;
			}

			if($special_title)
			{
				\dash\face::title(\dash\face::title(). ' ['. $special_title. ']');
			}
		}

		/*================================
		=            Btn save            =
		================================*/
		if(\lib\store::detail('force_stop_sitebuilder_auto_save'))
		{
			\dash\face::btnSave(true);
			\dash\face::btnSaveText(T_("Save & Publish"));
			\dash\face::btnSaveClass('btn-primary');
			\dash\face::btnSaveForm(\dash\url::here(). '/page?id='. \dash\request::get('id'));
			\dash\face::btnSaveName('savepage');
			\dash\face::btnSaveValue('savepage');
		}
		else
		{
			$titleAutoSave = T_("Your change will be saved and published automatically");
			$msgAutoSave = T_("After any change in your page, data will be saved and published."). ' ';
			$msgAutoSave .= T_("If you want to disable auto-save and publish your change manually"). ' ';
			// $msgAutoSave .= '<a href="'. \dash\url::here(). '/autosave">'. T_("Click herer"). '</a>';
			$msgAutoSave .= T_("Go to site builder setting and turn off this feature");
			$btnSaveAttr = 'data-notif="'.$msgAutoSave.'" data-notif-title="'.$titleAutoSave.'" data-notif-type="info" data-notif-icon="person"  data-alerty=""';
			\dash\face::btnSave(true);
			\dash\face::btnSaveText(T_("Auto Save & Publish"));
			\dash\face::btnSaveClass('btn-outline-secondary btn-sm');
			\dash\face::btnSaveAttr($btnSaveAttr);
		}
		/*=====  End of Btn save  ======*/


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

		$display_link = $link;

		$get = [];

		// if(\dash\data::currentPageDetail_status() !== 'publish')
		// {
		// 	$get['preview'] = 'yes';
		// }
		$referer = \dash\server::referer();
		if($_include_time || \dash\str::strpos($referer, 'gallery/image_list') !== false)
		{
			$get['time'] = time();
		}

		$get['preview'] = md5(\dash\data::currentPageDetail_datecreated());

		\dash\data::btnPreviewSiteBuilderOneSection($link. '?'. \dash\request::build_query(array_unique(array_merge($get, ['psid' => \dash\request::get('sid')]))));

		$id       = null;
		$fragment = null;

		if(($model = a(\dash\data::currentSectionDetail(), 'model')) && ($section_id = a(\dash\data::currentSectionDetail(), 'id')))
		{
			$id = implode('-', [$model, $section_id]);
			$fragment = '#'. $id;
		}

		if(\dash\request::get('sid'))
		{
			$get['focus'] = $id;
		}

		$origin_link = $link;

		$analyze_url = \dash\validate\url::parseUrl($origin_link);

		$origin_link = a($analyze_url, 'protocol'). '://'. a($analyze_url, 'domain');


		// set isiframe to iframe link
		$get['isiframe'] = 'yes';
		$iframe_link     = $link . '?'. \dash\request::build_query($get). $fragment;

		// unset focus and isiframe from click iframe link
		unset($get['focus']);
		unset($get['isiframe']);
		$click_iframe_link = $link . '?'. \dash\request::build_query($get). $fragment;


		\dash\data::iframeLink($iframe_link);
		\dash\data::iframeClickLink($click_iframe_link);
		\dash\data::iframeDisplayLink($display_link);
		\dash\data::iframeOriginLink($origin_link);

	}

}
?>