<?php
namespace content_a\form\report;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		$load = \lib\app\form\form\get::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}
		\dash\data::formDetail($load);

		\dash\face::title(T_('Report'). ' | '. \dash\data::formDetail_title());

		// back
		\dash\data::back_text(T_('Back'));
		\content_a\form\home\view::backModuleLink();


		$items = \lib\app\form\item\get::items_answerable($id);

		\dash\data::formItems($items);


	}

}
?>
