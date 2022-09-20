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

		// preview
		if(\dash\data::dataRow_privacy() === 'private')
		{
			// nolink
		}
		else
		{
			if(\dash\data::dataRow_url())
			{
				\dash\face::btnView(\dash\data::dataRow_url());
			}
			else
			{

				\dash\face::btnView(\lib\store::url() . '/f/' . \dash\request::get('id'));
			}
		}
	}

}

?>
