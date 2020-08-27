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
		$answer = \dash\get::index($_result, 'answer');
		$answerdetail = \dash\get::index($_result, 'answerdetail');
		$items        = \dash\get::index($_result, 'items');

		if(!is_array($answerdetail))
		{
			$answerdetail = [];
		}

		if(!is_array($answer))
		{
			$answer = [];
		}

		if(!is_array($items))
		{
			$items = [];
		}

		$items = array_map(['\\lib\\app\\form\\item\\ready', 'row'], $items);

		$items = array_combine(array_column($items, 'id'), $items);

		$template = [];


		foreach ($items as $item_id => $item_detail)
		{
			$type = isset($item_detail['type']) ? $item_detail['type'] : null;
			if($type === 'message')
			{
				continue;
			}

			$choice = (isset($item_detail['choice']) && is_array($item_detail['choice'])) ? $item_detail['choice'] : [];

			if($type === 'multiple_choice')
			{
				if(!isset($template[$item_id]))
				{
					$template[$item_id] = [];
					foreach ($choice as $one_choice)
					{
						if(isset($one_choice['title']))
						{
							$template[$item_id][$one_choice['title']] = null;
						}
					}

					$template[$item_id]['other_choice'] = [];
				}

			}
			else
			{
				if(!isset($template[$item_id]))
				{
					$template[$item_id] = null;
				}
			}
		}

		$export = [];

		foreach ($answerdetail as $one_answer)
		{
			$this_item_id     = isset($one_answer['item_id']) ? $one_answer['item_id'] : null;
			$this_item_detail = [];

			if($this_item_id)
			{
				$this_item_detail = isset($items[$this_item_id]) ? $items[$this_item_id] : [];
			}

			if(!isset($this_item_detail['type']))
			{
				continue;
			}

			if($this_item_detail['type'] === 'message')
			{
				continue;
			}

			if(!isset($one_answer['answer_id']))
			{
				continue;
			}

			$my_answer_id = $one_answer['answer_id'];

			if(!isset($export[$my_answer_id]))
			{
				$export[$my_answer_id] = $template;
			}

			if($this_item_detail['type'] === 'multiple_choice')
			{
				if(array_key_exists($one_answer['answer'] , $export[$my_answer_id][$this_item_id]))
				{
					$export[$my_answer_id][$this_item_id][$one_answer['answer']] = $one_answer['answer'];
				}
				else
				{
					$export[$my_answer_id][$this_item_id]['other_choice'][] = $one_answer['answer'];
				}
			}
			elseif($this_item_detail['type'] === 'descriptive_answer')
			{
				$export[$my_answer_id][$this_item_id] = $one_answer['textarea'];
			}
			elseif($this_item_detail['type'] === 'file')
			{
				$export[$my_answer_id][$this_item_id] = $one_answer['file'];
			}
			else
			{
				$export[$my_answer_id][$this_item_id] = $one_answer['answer'];
			}
		}

		$new_export = [];

		foreach ($export as $answer_id => $answer_detail)
		{
			foreach ($answer_detail as $item_id => $answer)
			{
				if(is_array($answer))
				{
					foreach ($answer as $choice => $choice_answer)
					{
						if(is_array($choice_answer))
						{
							$choice_answer = implode(',', $choice_answer);
						}

						$new_export[$answer_id][$items[$item_id]['title']. ' - '. $choice] = $choice_answer;
					}
				}
				else
				{
					$new_export[$answer_id][$items[$item_id]['title']] = $answer;
				}
			}
		}

		return $new_export;
	}
}
?>