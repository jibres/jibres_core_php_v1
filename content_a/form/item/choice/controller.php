<?php
namespace content_a\form\item\choice;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');

		$load = \lib\app\form\form\get::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::dataRow($load);

		$item = \dash\request::get('item');

		$load_item = \lib\app\form\item\get::get($item);
		if(!$load_item)
		{
			\dash\header::status(404);
		}

		\dash\data::itemDetail($load_item);


		$cid = \dash\request::get('cid');
		if($cid)
		{

			$load_choice = \lib\app\form\choice\get::get($cid);
			if(!$load_choice)
			{
				\dash\header::status(404);
			}
			\dash\data::editMode(true);
			\dash\data::choiceDataRow($load_choice);

		}

	}
}
?>
