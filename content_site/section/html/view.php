<?php
namespace content_site\section\html;


class view
{

	public static function config()
	{
		\content_site\view::fill_page_detail();

		\dash\data::include_adminPanelBuilder(true);
		\dash\data::btnSaveSiteBuilder(false);
		\dash\data::btnSaveSiteBuilderHtml(true);

		if(\dash\data::mySectionID())
		{
			$load_section = \lib\db\pagebuilder\get::by_id(\dash\data::mySectionID());

			$preview = a($load_section, 'preview');
			$preview = json_decode($preview, true);
			if(a($preview, 'heading'))
			{
				\dash\data::myHtmlTitle(a($preview, 'heading'));
			}

			$myHtmlText = a($load_section, 'text_preview');

			$myHtmlText = str_replace('><', ">\n<", $myHtmlText);

			\dash\data::myHtmlText($myHtmlText);
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
	}
}
?>