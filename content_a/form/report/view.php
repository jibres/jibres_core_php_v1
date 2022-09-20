<?php
namespace content_a\form\report;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		\content_a\form\edit\view::form_preview_link();



		\dash\face::title(T_('Report'). ' | '. \dash\data::dataRow_title());

		// back
		\dash\data::back_text(T_('Back'));
		\content_a\form\home\view::backModuleLink();


		$items = \lib\app\form\item\get::items_answerable($id);

		\dash\data::formItems($items);


	}

}
?>
