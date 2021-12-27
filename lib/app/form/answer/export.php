<?php
namespace lib\app\form\answer;

class export
{

	public static function count_all($_form_id)
	{
		\dash\permission::access('ManageForm');

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
			\dash\utility\export::csv(['name' => 'export-form-'. $form_id. '-'.date("Y-m-d").'-'. date("His"). '-'. $count_all, 'data' => $list]);
			return;
		}
	}



	public static function queue($_form_id)
	{
		\dash\permission::access('ManageForm');

		$form_id = \dash\validate::id($_form_id);

		$count_all = self::count_all($form_id);
		if(!$count_all)
		{
			\dash\notif::info(T_("You have not any answer to export"));
			return;
		}

		return \lib\app\export\add::request('form_answer', ['related' => 'form', 'related_id' => $_form_id]);

	}



	public static function remove($_id)
	{
		\dash\permission::access('ManageForm');

		return \lib\app\export\remove::request('form_answer', $_id);

	}


	public static function list($_form_id)
	{
		\dash\permission::access('ManageForm');

		$get_by_type = \lib\db\export\get::by_type_related_id('form_answer', $_form_id);
		$get_by_type = array_map(['\\lib\\app\\export\\ready', 'row'], $get_by_type);
		return $get_by_type;
	}


	/**
	 * Ready data to export
	 * this function needless to call permission caller
	 *
	 * @param      <type>         $_result  The result
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function ready_for_export($_result)
	{
		unset($answer);
		unset($answerdetail);
		unset($items);
		unset($template);
		unset($type);
		unset($choice);
		unset($export);
		unset($this_item_detail);
		unset($this_item_detail);
		unset($my_answer_id);
		unset($new_export);



		$answer       = a($_result, 'answer');
		$answerdetail = a($_result, 'answerdetail');
		$items        = a($_result, 'items');

		if(!is_array($answerdetail))
		{
			$answerdetail = [];
		}

		if(!$answerdetail)
		{
			return false;
		}

		if(!is_array($answer))
		{
			$answer = [];
		}

		if(!is_array($items))
		{
			$items = [];
		}

		$all_choice_raw = a($_result, 'choice');
		$allChoice     = [];

		if(!is_array($all_choice_raw))
		{
			$all_choice_raw = [];
		}

		$all_choice_raw = array_map(['\\lib\\app\\form\\choice\\ready', 'row'], $all_choice_raw);

		foreach ($all_choice_raw as $key => $value)
		{
			if(!isset($allChoice[$value['item_id']]))
			{
				$allChoice[$value['item_id']] = [];
			}

			$allChoice[$value['item_id']][] = $value;
		}

		$new_item = [];
		foreach ($items as $key => $value)
		{
			$new_item[] = \lib\app\form\item\ready::row($value, $allChoice);
		}

		$items = $new_item;

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
						if(isset($one_choice['id']))
						{
							$template[$item_id][$one_choice['id']] = null;
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
				if(array_key_exists($one_answer['choice_id'] , $export[$my_answer_id][$this_item_id]))
				{
					$export[$my_answer_id][$this_item_id][$one_answer['choice_id']] = $one_answer['answer'];
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
			$new_export[$answer_id]['answer_id'] = $answer_id;

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

						$new_export[$answer_id][$items[$item_id]['id']. '_'. $choice] = $choice_answer;
					}
				}
				else
				{
					$new_export[$answer_id][$items[$item_id]['id']] = $answer;
				}
			}
		}

		return $new_export;
	}



	public static $sql_column_list = [];

	public static function ready_for_export_sql($_result, $_table_name)
	{
		$result = self::ready_for_export($_result);
		if(!is_array($result))
		{
			return;
		}

		$new_result = [];

		foreach ($result as $key => $value)
		{
			foreach ($value as $k => $v)
			{
				if($k)
				{
					$myKey = 'f_'. $k;

					$new_result[$key][$myKey] = $v;
					self::$sql_column_list[$myKey] = $k;
				}
			}
		}

		$sql = [];
		foreach ($new_result as $key => $value)
		{
			$sql[] = "INSERT IGNORE INTO `$_table_name` SET ". self::make_set($value, ['type' => 'insert']);
		}

		return $sql;
	}


	/**
	 * Makes a set.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function make_set($_args, $_options = [])
	{
		$default_options =
		[
			'type' => 'update',
		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_options, $_options);

		$set = [];
		foreach ($_args as $key => $value)
		{
			if(!is_string($key))
			{
				continue;
			}

			if($value === null)
			{
				if($_options['type'] === 'insert')
				{
					// continue;
				}
				else
				{
					$set[] = " `$key` = NULL ";
				}
			}
			elseif(is_string($value) && (!isset($value) || $value == '' ))
			{
				if($_options['type'] === 'insert')
				{
					// continue;
				}
				else
				{
					$set[] = " `$key` = NULL ";
				}
			}
			elseif(is_string($value))
			{
				$set[] = " `$key` = '$value' ";
			}
			elseif(is_numeric($value))
			{
				$set[] = " `$key` = $value ";
			}
			elseif(is_bool($value))
			{
				if($value)
				{
					$set[] = " `$key` = 1 ";
				}
				else
				{
					$set[] = " `$key` = NULL ";
				}
			}
			else
			{
				$set[] = " `$key` = '$value' ";
			}
		}

		if(!empty($set))
		{
			if($_options['type'] === 'update')
			{
				$set = implode(',', $set);
			}
			elseif($_options['type'] === 'insert')
			{
				$set = implode(',', $set);
			}
			else
			{
				$set = false;
			}
		}
		else
		{
			$set = false;
		}
		return $set;
	}


}
?>