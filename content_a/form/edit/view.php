<?php
namespace content_a\form\edit;


class view
{

	public static function config()
	{
		\dash\face::title(T_('Edit new contact form'));

		\content_a\form\edit\view::form_preview_link();

		\content_a\form\home\view::backModuleLink();

		$form_id = \dash\request::get('id');

		$items = \lib\app\form\item\get::items($form_id, false, false, true);

		\dash\data::formItems($items);

	}


	public static function form_preview_link()
	{
		$data = \dash\data::dataRow();
		if(!$data)
		{
			$data = \dash\data::formDetail();
		}

		// preview
		if(a($data, 'privacy') === 'private')
		{
			// nolink
		}
		else
		{
			if(a($data, 'url'))
			{
				\dash\face::btnView($data['url']);
			}
			else
			{
				\dash\face::btnView(\lib\store::url() . '/f/' . \dash\request::get('id'));
			}
		}
	}

}

?>
