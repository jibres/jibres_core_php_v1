<?php
namespace content_a\form\resultpage;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Result page'));

		// back
		\dash\data::back_text(T_('Back'));
		\content_a\form\home\view::backModuleLink();

		$form_id = \dash\request::get('id');

		\dash\face::btnSave('form1');

		$items = \lib\app\form\item\get::items_resulpageable($form_id);

		\dash\data::formItems($items);

		foreach ($items as $item)
		{
			if(isset($item['type_detail']['is_amount']) && $item['type_detail']['is_amount'])
			{
				\dash\data::isAmountForm(true);
				break;
			}
		}


		$tag_list = \lib\app\form\tag\get::all_tag();

		if(!is_array($tag_list))
		{
			$tag_list = [];
		}

		\dash\data::listTag($tag_list);


	}
}
?>
