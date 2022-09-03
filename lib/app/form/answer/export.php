<?php
namespace lib\app\form\answer;

class export
{

	public static function count_all($_form_id, $_args = [])
	{
		\dash\permission::access('ManageForm');

		$form_id = \dash\validate::id($_form_id);
		$count_product_available = \lib\db\form_answer\get::count_all_where($form_id, $_args);
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



	public static function queue($_form_id, $_args = [])
	{
		\dash\permission::access('ManageForm');

		$form_id = \dash\validate::id($_form_id);


		$condition =
		[
			'startdate' => 'date',
			'enddate'   => 'date',
			'starttime' => 'time',
			'endtime'   => 'time',
			'tag_id'    => 'id',
		];

		$require = [];
		$meta    = [];
		$data    = \dash\cleanse::input($_args, $condition, $require, $meta);


		$startdate = null;
		if($data['startdate'])
		{
			$startdate = $data['startdate'];

			if($data['starttime'])
			{
				$startdate .= ' '. $data['starttime'];
			}
			else
			{
				$startdate .= ' 00:00:00';
			}
		}

		$enddate = null;
		if($data['enddate'])
		{
			$enddate = $data['enddate'];

			if($data['endtime'])
			{
				$enddate .= ' '. $data['endtime'];
			}
			else
			{
				$enddate .= ' 23:59:59';
			}
		}

		if($startdate && $enddate)
		{
			if(strtotime($startdate) > strtotime($enddate))
			{
				\dash\notif::error(T_("Start date must be less than end date!"), ['element' => ['startdate', 'enddate', 'starttime', 'endtime']]);
				return false;
			}
		}

		$new_args =
		[
			'startdate' => $startdate,
			'enddate'   => $enddate,
			'tag_id'    => $data['tag_id'],
		];


		$count_all = self::count_all($form_id, $new_args);
		if(!$count_all)
		{
			\dash\notif::error(T_("By this filter You have not any answer to export"));
			return false;
		}

		return \lib\app\export\add::request('form_answer', ['related' => 'form', 'related_id' => $_form_id, 'args' => $new_args]);

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

        $answer_status = a($answer, 'status');

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

		// $value = \lib\app\form\answer\get::HTMLshowDetaiRecrod($value);

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
			elseif($this_item_detail['type'] === 'date' || $this_item_detail['type'] === 'birthdate')
			{
				$export[$my_answer_id][$this_item_id] = \dash\fit::date_en($one_answer['answer']);
			}
			elseif($this_item_detail['type'] === 'country')
			{
				if($one_answer['answer'])
				{
					$export[$my_answer_id][$this_item_id] = $one_answer['answer']. ' - '. \dash\utility\location\countres::get_localname($one_answer['answer']);
				}
				else
				{
					$export[$my_answer_id][$this_item_id] = $one_answer['answer'];
				}
			}
			elseif($this_item_detail['type'] === 'province')
			{
				if($one_answer['answer'])
				{
					$export[$my_answer_id][$this_item_id] = $one_answer['answer']. ' - '. \dash\utility\location\provinces::get_localname($one_answer['answer']);
				}
				else
				{
					$export[$my_answer_id][$this_item_id] = $one_answer['answer'];
				}
			}
			elseif($this_item_detail['type'] === 'province_city')
			{
				if($one_answer['answer'])
				{
					$province           = substr($one_answer['answer'], 0, 5);
					$city               = substr($one_answer['answer'], 6);

					if($province)
					{
						$export[$my_answer_id][$this_item_id] = $one_answer['answer']. ' - '. \dash\utility\location\provinces::get_localname($province);
					}

					if($city)
					{
						$export[$my_answer_id][$this_item_id] = $one_answer['answer']. ' - '. \dash\utility\location\cites::get_localname($city);
					}
				}
				else
				{
					$export[$my_answer_id][$this_item_id] = $one_answer['answer'];
				}
			}

			else
			{
				$export[$my_answer_id][$this_item_id] = $one_answer['answer'];
			}

            $export[$my_answer_id]['date'] = \dash\utility\convert::to_en_number(\dash\fit::date_time($one_answer['datecreated']));
		}

		$new_export = [];


		foreach ($export as $answer_id => $answer_detail)
		{
			$new_export[$answer_id]['answer_id'] = $answer_id;

			foreach ($answer_detail as $item_id => $answerDetail)
			{
				if(is_array($answerDetail))
				{
					foreach ($answerDetail as $choice => $choice_answer)
					{
						if(is_array($choice_answer))
						{
							$choice_answer = implode(',', $choice_answer);
						}

						$new_export[$answer_id][$items[$item_id]['id']. '_'. $choice] = $choice_answer;
					}
				}
				elseif(is_numeric($item_id))
				{
					$new_export[$answer_id][$items[$item_id]['id']] = $answerDetail;
				}
				else
				{
					$new_export[$answer_id][$item_id] = $answerDetail;
				}
			}
		}

		$replace_item_id_to_item_title = [];

		foreach ($new_export as $answer_id => $answer_detail)
		{
			$temp = [];

			foreach ($answer_detail as $key => $value)
			{

				$item_id      = null;
				$choice_id    = null;
				$choice_title = null;

				if(preg_match("/^\d+\_\d+$/", $key))
				{
					$split     = explode('_', $key);
					$item_id   = $split[0];
					$choice_id = $split[1];
				}
				elseif(is_numeric($key))
				{
					$item_id = $key;
				}
				else
				{
					$temp[$key] = $value;
					continue;
				}

				$item_title = a($items, $item_id, 'title');

				if($choice_id)
				{
					if(is_array(a($allChoice, $item_id)))
					{
						foreach ($allChoice[$item_id] as $k => $v)
						{
							if(a($v, 'id') == $choice_id)
							{
								$choice_title = a($v, 'title');
								break;
							}
						}
					}
				}

				$new_key = $key. '_'. $item_title;

				if($choice_title)
				{
					$new_key .= '_'. $choice_title;
				}

				$temp[$new_key] = $value;
			}

			$load_tags           = \lib\db\form_tag\get::string_all_tag($answer_id);
			$load_comments       = \lib\db\form_comment\get::string_all_comment($answer_id);
            $temp['answer_status'] = $answer_status;
			$temp['tags']        = $load_tags;
			$temp['comments']    = $load_comments;
			$temp['inquirytime'] = null;


			$replace_item_id_to_item_title[$answer_id] = $temp;
		}


		foreach ($answer as $key => $value)
		{
			if(isset($value['inquirytimes']) && $value['inquirytimes'])
			{
				$times = json_decode($value['inquirytimes'], true);
				if(isset($times['last']['time']) && isset($value['id']) && isset($replace_item_id_to_item_title[$value['id']]))
				{
					$replace_item_id_to_item_title[$value['id']]['inquirytime'] = \dash\utility\convert::to_en_number(\dash\fit::date_time($times['last']['time']));
				}
			}
            $replace_item_id_to_item_title[$value['id']]['answer_status'] = a($value, 'status');

		}

		return $replace_item_id_to_item_title;

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
					switch ($k)
					{
						case 'answer_id':
							$myKey = 'f_'. $k;
							break;
						default:
							$myKey = 'f_'. substr($k, 0, strpos($k, '_'));
							break;
					}

					if($myKey === 'f_' || $myKey === 'f_answer')
					{
						continue;
					}

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