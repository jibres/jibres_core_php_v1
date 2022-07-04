<?php
namespace lib\app\form\condition;


class get
{
	public static function list($_form_id)
	{
		$form = \lib\app\form\form\get::by_id($_form_id);

		$condition = [];

		if(isset($form['condition']) && is_array($form['condition']))
		{
			$my_condition = $form['condition'];

			$all_ids = [];
			$all_ids = array_merge($all_ids, array_column($form['condition'], 'if'));
			$all_ids = array_merge($all_ids, array_column($form['condition'], 'then'));
			$all_ids = array_merge($all_ids, array_column($form['condition'], 'else'));

			$all_ids = array_filter($all_ids);
			$all_ids = array_unique($all_ids);

			$item_load_multi = [];

			if($all_ids)
			{
				$item_load_multi = \lib\db\form_item\get::by_multi_id(implode(',', $all_ids));
				if(!is_array($item_load_multi))
				{
					$item_load_multi = [];
				}

				$item_load_multi = array_combine(array_column($item_load_multi, 'id'), $item_load_multi);

			}

			foreach ($my_condition as $key => $value)
			{
				if(isset($value['if']) && isset($item_load_multi[$value['if']]['title']))
				{
					$my_condition[$key]['if_title'] = $item_load_multi[$value['if']]['title'];
				}

				if(isset($value['else']) && isset($item_load_multi[$value['else']]['title']))
				{
					$my_condition[$key]['else_title'] = $item_load_multi[$value['else']]['title'];
				}

				if(isset($value['then']) && isset($item_load_multi[$value['then']]['title']))
				{
					$my_condition[$key]['then_title'] = $item_load_multi[$value['then']]['title'];
				}
			}

			$condition = $my_condition;
		}


		return $condition;

	}
}
?>
