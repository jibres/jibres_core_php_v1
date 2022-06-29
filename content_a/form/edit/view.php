<?php
namespace content_a\form\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit new contact form'));

		\content_a\form\edit\view::form_preview_link();
		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$form_id = \dash\request::get('id');

		\dash\face::btnDuplicate(\dash\url::this(). '/duplicate?id='. $form_id);


		$items = \lib\app\form\item\get::items($form_id);

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
			\dash\face::btnPreview(\lib\store::url(). '/f/'. \dash\request::get('id'));
		}
	}
}
?>
