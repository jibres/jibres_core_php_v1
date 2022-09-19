<?php
namespace content_a\form\dashboard;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Form Dashboard'));

		\content_a\form\edit\view::form_preview_link();
		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$form_id = \dash\request::get('id');





	}


	public static function form_preview_link()
	{

		// preview
		if(\dash\data::dataRow_privacy() === 'private')
		{
			// nolink
		}
		else
		{
			\dash\face::btnView(\lib\store::url(). '/f/'. \dash\request::get('id'));
		}
	}
}
?>
