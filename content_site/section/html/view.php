<?php
namespace content_site\section\html;


class view
{

	public static function config()
	{
		\content_site\view::fill_page_detail();

		\dash\data::include_m2('siteBuilder');

		\dash\face::btnSave('savehtmlform');
		\dash\face::btnSaveForm(false);
		\dash\face::btnSaveText(T_("Save HTML"));
		\dash\face::btnSaveClass('btn-primary');
		\dash\face::btnSaveName('savehtml');
		\dash\face::btnSaveValue('html');
		\dash\face::btnSaveAttr(null);

		if(\dash\data::mySectionID())
		{
			$load_section = \lib\db\sitebuilder\get::by_id(\dash\data::mySectionID());

			$preview = a($load_section, 'preview');
			$preview = json_decode($preview, true);
			if(a($preview, 'heading'))
			{
				\dash\data::myHtmlTitle(a($preview, 'heading'));
			}

			$myHtmlText = a($load_section, 'text_preview');

			$myHtmlText = str_replace('><', ">\n<", $myHtmlText);
			$myHtmlText = str_replace('} ', "}\n ", $myHtmlText);

			\dash\data::myHtmlText($myHtmlText);
		}
		else
		{
			\dash\data::myHtmlText(\dash\file::read(__DIR__. '/sample.html'));
		}

		\dash\data::back_text(T_("Back"));

		if(\dash\request::get('sid'))
		{
			\dash\data::back_link(\dash\url::here(). '/page'. \dash\request::full_get(['sid' => null]));
		}
		else
		{
			\dash\data::back_link(\dash\url::this(). \dash\request::full_get(['folder' => 'body']));
		}

		\dash\data::myIframePreviewHmtl(\dash\data::btnPreviewSiteBuilderOneSection());

	}
}
?>