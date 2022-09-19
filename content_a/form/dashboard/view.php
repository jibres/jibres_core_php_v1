<?php
namespace content_a\form\dashboard;


use lib\app\form\form\get;

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

		$dashboardDetail = \lib\app\form\form\dashboard::detail($form_id);

		\dash\data::dashboardDetail($dashboardDetail);




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
