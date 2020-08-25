<?php
namespace lib\app\form\answer;

class export
{

	public static function count_all($_form_id)
	{
		$form_id = \dash\validate::id($_form_id);
		$count_product_available = \lib\db\form_answer\get::count_all($form_id);
		return intval($count_product_available);
	}


	public static function download_now($_form_id)
	{
		$form_id = \dash\validate::id($_form_id);
		$count_all = self::count_all($_form_id);

		if($count_all > 50)
		{
			\dash\redirect::to(\dash\url::this());
		}
		else
		{
			$list = \lib\db\form_answer\get::export_list($form_id);
			$list = self::ready_for_export($list);
			\dash\utility\export::csv(['name' => 'answer_form_'. $form_id. '_'.date("Y_m_d"). '_'. $count_all, 'data' => $list]);
			return;
		}
	}



	public static function queue()
	{
		$count_all = self::count_all();
		if(!$count_all)
		{
			\dash\notif::info(T_("You have not any product to export"));
			return;
		}

		return \lib\app\export\add::request('products');

	}


	public static function list()
	{
		$get_by_type = \lib\db\export\get::by_type('products');
		$get_by_type = array_map(['\\lib\\app\\export\\ready', 'row'], $get_by_type);
		return $get_by_type;
	}


	private static function ready_for_export($_result)
	{
		$answerdetail = \dash\get::index($_result, 'answerdetail');
		$items        = \dash\get::index($_result, 'items');

		if(!is_array($answerdetail))
		{
			$answerdetail = [];
		}

		if(!is_array($items))
		{
			$items = [];
		}

		$items = array_combine(array_column($items, 'id'), $items);

		$temp_for_copy = array_column($items, 'id');

		$export = [];
		foreach ($answerdetail as $key => $value)
		{
			if(!isset($export[$value['answer_id']]))
			{
				$export[$value['answer_id']] = [];
				foreach ($temp_for_copy as $k => $v)
				{
					$export[$value['answer_id']][$v] = null;
				}
			}

			$export[$value['answer_id']][$value['item_id']] = $value['answer'];
		}

		$new_export = [];

		foreach ($export as $key => $value)
		{
			foreach ($value as $k => $v)
			{
				$new_export[$key][$items[$k]['title']] = $v;
			}
		}

		return $new_export;
	}
}
?>