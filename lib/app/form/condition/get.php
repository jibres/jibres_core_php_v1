<?php
namespace lib\app\form\condition;


class get
{
	public static function list($_form_id)
	{
		$form = \lib\app\form\form\get::by_id($_form_id);

		$condition     = [];
		$all_ids       = [];
		$then_else_ids = [];


		if(isset($form['condition']) && is_array($form['condition']))
		{
			$my_condition = $form['condition'];

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
					$then_else_ids[] = $value['else'];
				}

				if(isset($value['then']) && isset($item_load_multi[$value['then']]['title']))
				{
					$my_condition[$key]['then_title'] = $item_load_multi[$value['then']]['title'];
					$then_else_ids[] = $value['then'];
				}
			}

			$condition = $my_condition;
		}

		\dash\data::myConditoinExistID($all_ids);
		\dash\data::myConditoinThenElseIDS($then_else_ids);

		return $condition;

	}


	private static $form_loaded        = false;
	private static $form_condition     = [];
	private static $form_condition_ids = [];

	public static function item_have_condition($_form_id, $_item_id)
	{
		if(!self::$form_loaded)
		{
			self::$form_loaded = true;

			self::$form_condition = self::list($_form_id);

			self::$form_condition_ids = \dash\data::myConditoinExistID();
		}



		if(self::$form_condition)
		{
			$html = '';

			foreach (self::$form_condition as $key => $value)
			{
				$found = false;
				$data_response_where = '';

				if($value['then'] == $_item_id)
				{
					$found = true;
					$data_response_where = 'data-response-where';
				}
				elseif($value['else'] == $_item_id)
				{
					$found = true;
					$data_response_where = 'data-response-where-not';
				}

				if($found)
				{
					$html .= '<div data-response="a_'. $value['if']. '" ';
					$html .= $data_response_where . '="'. $value['value']. '" ';
					$html .= 'data-response-hide ';
					$html .= '>';
					return $html;

				}
			}
		}

		return null;
	}
}
?>
