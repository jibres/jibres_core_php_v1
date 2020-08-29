<?php
namespace lib\app\form;


class report
{
	public static function check($_item)
	{
		if(!$_item || !is_array($_item))
		{
			return null;
		}

		$type = isset($_item['type']) ? $_item['type']: null;

		if(!$type)
		{
			return null;
		}

		if(isset($_item['type_detail']['chart']) && $_item['type_detail']['chart'])
		{
			// ok
		}
		else
		{
			return null;
		}

		if(isset($_item['type_detail']['chart_type']) && $_item['type_detail']['chart_type'])
		{
			$chart_type = $_item['type_detail']['chart_type'];
		}
		else
		{
			return null;
		}

		$item_id = \dash\get::index($_item, 'id');

		if(!$item_id)
		{
			return null;
		}

		$form_id = \dash\get::index($_item, 'form_id');

		if(!$form_id)
		{
			return null;
		}

		if(!$_item || !is_array($_item))
		{
			return null;
		}

		$type = isset($_item['type']) ? $_item['type']: null;

		if(!$type)
		{
			return null;
		}

		if(isset($_item['type_detail']['chart']) && $_item['type_detail']['chart'])
		{
			// ok
		}
		else
		{
			return null;
		}



		return
		[
			'item_id'    => $item_id,
			'form_id'    => $form_id,
			'type'       => $type,
			'chart_type' => $chart_type,
		];
	}


	public static function chart($_item)
	{
		if(!isset($_item['type_detail']['chart_type']))
		{
			return null;
		}

		switch ($_item['type_detail']['chart_type'])
		{
			case 'pie':
				return self::chart_pie($_item);
				break;

			case 'bar':
				return self::chart_bar($_item);
				break;

			case 'province':
				return self::chart_province($_item);
				break;

			case 'wordcloud':
				return self::chart_wordcloud($_item);
				break;

			default:
				# code...
				break;
		}
	}


	public static function chart_pie($_item)
	{
		$var = self::check($_item);

		if(!$var)
		{
			return null;
		}

		extract($var);

		$load_answer = \lib\db\form_answerdetail\get::chart_pie($form_id, $item_id);
		if(!is_array($load_answer))
		{
			$load_answer = [];
		}

		$all_answer_count = \lib\db\form_answer\get::count_by_form_id($form_id);
		$chart        = [];
		$table        = [];
		$count_answer = null;
		$not_answer   = null;
		$percent_answer = null;


		if(in_array($type, ['dropdown', 'single_choice', 'multiple_choice']))
		{
			$count_answer = \lib\db\form_answerdetail\get::count_answer_item_id($form_id, $item_id);

			$not_answer   = floatval($all_answer_count) - floatval($count_answer);
			if($not_answer < 0)
			{
				$not_answer = 0;
			}

			$other_choice_percent = 0;
			$other_choice_percent_title = null;
			$other_choice_percent_count = 0;

			foreach ($load_answer as $key => $value)
			{
				if(isset($value['count']) && isset($value['answer']))
				{
					if($all_answer_count && $value['count'])
					{
						$percent = round(((floatval($value['count']) * 100) / $all_answer_count), 2);
					}

					if(floatval($percent) < 1)
					{
						$other_choice_percent_title = $value['answer'];
						$other_choice_percent_count++;
						$other_choice_percent += floatval($value['count']);
					}
					else
					{
						$chart[] = ['name' => $value['answer'], 'y' =>  floatval($value['count'])];
					}

					$table[] = ['name' => $value['answer'], 'count' =>  floatval($value['count']), 'percent' => $percent];
				}
			}

			if($other_choice_percent)
			{
				if($other_choice_percent_count === 1)
				{
					$chart[] = ['name' => $other_choice_percent_title, 'y' =>  floatval($other_choice_percent)];
				}
				else
				{
					$chart[] = ['name' => T_("Other choice"), 'y' =>  floatval($other_choice_percent)];
				}
			}

			if($not_answer)
			{
				if($all_answer_count && $not_answer)
				{
					$percent = round((($not_answer * 100) / $all_answer_count), 2);
				}

				$chart[] = ['name' => T_("Not answer"), 'y' =>  floatval($not_answer)];
				$table[] = ['name' => T_("Not answer"), 'count' =>  floatval($not_answer), 'percent' => $percent];
			}
		}

		if($all_answer_count && $count_answer)
		{
			$percent_answer = round((($count_answer * 100) / $all_answer_count), 2);
		}

		$result                      = [];
		$result['chart_type']        = 'pie';
		$result['count_answer_all']  = $all_answer_count;
		$result['count_answer_item'] = $count_answer;
		$result['count_not_answer']  = $not_answer;
		$result['percent_answer']    = $percent_answer;
		$result['data_table']        = $table;
		$result['chart']             = json_encode($chart, JSON_UNESCAPED_UNICODE);

		return $result;
	}




	public static function chart_bar($_item)
	{
			$var = self::check($_item);

		if(!$var)
		{
			return null;
		}

		extract($var);

		$load_answer = \lib\db\form_answerdetail\get::chart_pie($form_id, $item_id);
		if(!is_array($load_answer))
		{
			$load_answer = [];
		}

		$all_answer_count = \lib\db\form_answer\get::count_by_form_id($form_id);
		$chart          = [];
		$table          = [];
		$count_answer   = null;
		$not_answer     = null;
		$percent_answer = null;
		$percent        = null;



		$count_answer = \lib\db\form_answerdetail\get::count_answer_item_id($form_id, $item_id);

		$not_answer   = floatval($all_answer_count) - floatval($count_answer);
		if($not_answer < 0)
		{
			$not_answer = 0;
		}

		$other_choice_percent = 0;
		$other_choice_percent_title = null;
		$other_choice_percent_count = 0;

		foreach ($load_answer as $key => $value)
		{
			if(isset($value['count']) && isset($value['answer']))
			{
				if($all_answer_count && $value['count'])
				{
					$percent = round(((floatval($value['count']) * 100) / $all_answer_count), 2);
				}

				if(floatval($percent) < 1)
				{
					$other_choice_percent_title = $value['answer'];
					$other_choice_percent_count++;
					$other_choice_percent += floatval($value['count']);
				}
				else
				{
					$chart[] = ['name' => $value['answer'], 'y' =>  floatval($value['count'])];
					$table[] = ['name' => $value['answer'], 'count' =>  floatval($value['count']), 'percent' => $percent];
				}

			}
		}

		if($other_choice_percent)
		{
			if($all_answer_count && $other_choice_percent)
			{
				$percent = round((($other_choice_percent * 100) / $all_answer_count), 2);
			}

			if($other_choice_percent_count === 1)
			{
				$chart[] = ['name' => $other_choice_percent_title, 'y' =>  floatval($other_choice_percent)];
				$table[] = ['name' => $other_choice_percent_title, 'count' =>  floatval($other_choice_percent), 'percent' => $percent];
			}
			else
			{
				$chart[] = ['name' => T_("Other choice"), 'y' =>  floatval($other_choice_percent)];
				$table[] = ['name' => T_("Other choice"), 'count' =>  floatval($other_choice_percent), 'percent' => $percent];
			}
		}

		if($not_answer)
		{
			if($all_answer_count && $not_answer)
			{
				$percent = round((($not_answer * 100) / $all_answer_count), 2);
			}

			$chart[] = ['name' => T_("Not answer"), 'y' =>  floatval($not_answer)];
			$table[] = ['name' => T_("Not answer"), 'count' =>  floatval($not_answer), 'percent' => $percent];
		}


		if($all_answer_count && $count_answer)
		{
			$percent_answer = round((($count_answer * 100) / $all_answer_count), 2);
		}

		$result                      = [];
		$result['chart_type']        = 'pie';
		$result['count_answer_all']  = $all_answer_count;
		$result['count_answer_item'] = $count_answer;
		$result['count_not_answer']  = $not_answer;
		$result['percent_answer']    = $percent_answer;
		$result['data_table']        = $table;
		$result['chart']             = json_encode($chart, JSON_UNESCAPED_UNICODE);

		return $result;
	}




	public static function chart_province($_item)
	{
		$var = self::check($_item);

		if(!$var)
		{
			return null;
		}

		extract($var);

		$load_answer = \lib\db\form_answerdetail\get::chart_pie($form_id, $item_id);
		if(!is_array($load_answer))
		{
			$load_answer = [];
		}

		foreach ($load_answer as $key => $value)
		{
			if(isset($value['answer']) && substr($value['answer'], 0, 2) === 'IR')
			{

			}
		}

		$all_answer_count = \lib\db\form_answer\get::count_by_form_id($form_id);
		$chart          = [];
		$table          = [];
		$count_answer   = null;
		$not_answer     = null;
		$percent_answer = null;
		$percent        = null;



		$count_answer = \lib\db\form_answerdetail\get::count_answer_item_id($form_id, $item_id);

		$not_answer   = floatval($all_answer_count) - floatval($count_answer);
		if($not_answer < 0)
		{
			$not_answer = 0;
		}

		$other_choice_percent = 0;
		$other_choice_percent_title = null;
		$other_choice_percent_count = 0;

		$real_answer = [];

		foreach ($load_answer as $key => $value)
		{
			if(preg_match("/^(IR\-(\d{2}))\-(.*)/", $value['answer'], $split))
			{
				$province = $split[1];
				$province_map_code = \dash\utility\location\provinces::get($province, null, 'map_code');
				if(isset($real_answer[$province_map_code]))
				{
					$real_answer[$province_map_code] = $real_answer[$province_map_code] + floatval($value['count']);
				}
				else
				{

					$real_answer[$province_map_code] = floatval($value['count']);
				}
			}
		}

		foreach ($real_answer as $map_code => $count)
		{
			$chart[] = [$map_code, intval($count)];
		}


		if($not_answer)
		{
			if($all_answer_count && $not_answer)
			{
				$percent = round((($not_answer * 100) / $all_answer_count), 2);
			}

			$table[] = ['name' => T_("Not answer"), 'count' =>  floatval($not_answer), 'percent' => $percent];
		}


		if($all_answer_count && $count_answer)
		{
			$percent_answer = round((($count_answer * 100) / $all_answer_count), 2);
		}

		$result                      = [];
		$result['chart_type']        = 'province';
		$result['count_answer_all']  = $all_answer_count;
		$result['count_answer_item'] = $count_answer;
		$result['count_not_answer']  = $not_answer;
		$result['percent_answer']    = $percent_answer;
		$result['data_table']        = $table;
		$result['chart']             = json_encode($chart, JSON_UNESCAPED_UNICODE);

		return $result;
	}


	public static function chart_wordcloud($_item)
	{
		$var = self::check($_item);

		if(!$var)
		{
			return null;
		}

		extract($var);

		$load_answer = \lib\db\form_answerdetail\get::chart_wordcloud($form_id, $item_id);
		if(!is_array($load_answer))
		{
			$load_answer = [];
		}

		$all_answer_count = \lib\db\form_answer\get::count_by_form_id($form_id);


		$word             = [];
		$myCount          = [];

		$count_load_answer     = count($load_answer);

		if($count_load_answer < 10)
		{
			$maxCountWord = 2;
		}
		elseif($count_load_answer < 200)
		{
			$maxCountWord = 10;
		}
		else
		{
			$maxCountWord = 0;
		}


		foreach ($load_answer as $key => $value)
		{

			$temp      = self::remove_2_char($value);

			$myCountTemp = array_count_values(explode(' ', $temp));

			foreach ($myCountTemp as $myWord => $myCountWord)
			{
				if(!isset($myCount[$myWord]))
				{
					$myCount[$myWord] = $myCountWord;
				}
				else
				{
					$myCount[$myWord] = $myCount[$myWord] + $myCountWord;
				}
			}
		}

		arsort($myCount);

		$count = 0;
		$chart = [];
		foreach ($myCount as $key => $value)
		{
			$count++;

			$chart[] = ['name' => $key, 'weight' => intval($value)];

			if($count > 100)
			{
				break;
			}
		}


		$table          = [];
		$count_answer   = null;
		$not_answer     = null;
		$percent_answer = null;
		$percent        = null;



		$count_answer = \lib\db\form_answerdetail\get::count_answer_item_id($form_id, $item_id);

		$not_answer   = floatval($all_answer_count) - floatval($count_answer);
		if($not_answer < 0)
		{
			$not_answer = 0;
		}



		if($all_answer_count && $count_answer)
		{
			$percent_answer = round((($count_answer * 100) / $all_answer_count), 2);
		}

		$result                      = [];
		$result['chart_type']        = 'wordcloud';
		$result['count_answer_all']  = $all_answer_count;
		$result['count_answer_item'] = $count_answer;
		$result['count_not_answer']  = $not_answer;
		$result['percent_answer']    = $percent_answer;
		$result['data_table']        = $table;

		$result['chart']             = json_encode($chart, JSON_UNESCAPED_UNICODE);

		return $result;
	}


	private static function remove_2_char($_text)
	{
		$word = [];
		$_text = strip_tags($_text);
		$_text = str_replace('[', ' ', $_text);
		$_text = str_replace(']', ' ', $_text);
		$_text = str_replace('{', ' ', $_text);
		$_text = str_replace('}', ' ', $_text);
		$_text = str_replace('"', ' ', $_text);
		$_text = str_replace('؛', ' ', $_text);
		$_text = str_replace("'", ' ', $_text);
		$_text = str_replace('(', ' ', $_text);
		$_text = str_replace(')', ' ', $_text);
		$_text = str_replace(':', ' ', $_text);
		$_text = str_replace(',', ' ', $_text);
		$_text = str_replace('،', ' ', $_text);
		$_text = str_replace('-', ' ', $_text);
		$_text = str_replace('_', ' ', $_text);
		$_text = str_replace('?', ' ', $_text);
		$_text = str_replace('؟', ' ', $_text);
		$_text = str_replace('.', ' ', $_text);
		$_text = str_replace('=', ' ', $_text);
		$_text = str_replace('
', ' ', $_text);

		$_text = str_replace("\n", ' ', $_text);
		$_text = str_replace('!', ' ', $_text);
		$_text = str_replace('&nbsp;', ' ', $_text);

		$split = explode(" ", $_text);

		foreach ($split as $key => $value)
		{
			$value = trim($value);
			if(mb_strlen($value) > 2 && !is_numeric($value))
			{
				$word[] = $value;
			}
		}

		$word = implode(' ', $word);
		$word = trim($word);
		return $word;
	}

	private static function fix_choice($_choice)
	{
		$new_choice = [];
		foreach ($_choice as $key => $value)
		{
			$new_choice[$value['title']] = $value['title'];
		}

		return $new_choice;
	}


	public static function compare($_q1, $_q2, $_q3)
	{
		$q1 = self::check($_q1);

		if(!$q1)
		{
			return null;
		}

		$q2 = self::check($_q2);

		if(!$q2)
		{
			return null;
		}

		$q3 = self::check($_q3);

		// if(!$q3)
		// {
		// 	return null;
		// }

		$form_id = $q1['form_id'];
		$q1_id = $_q1['id'];
		$q2_id = $_q2['id'];
		$q3_id = isset($_q3['id']) ? $_q3['id'] : null;

		$choice1 = \dash\get::index($_q1, 'choice');
		if(!is_array($choice1))
		{
			$choice1 = [];
		}

		$choice1 = self::fix_choice($choice1);

		$choice2 = \dash\get::index($_q2, 'choice');
		if(!is_array($choice2))
		{
			$choice2 = [];
		}
		$choice2 = self::fix_choice($choice2);

		$choice3 = \dash\get::index($_q3, 'choice');
		if(!is_array($choice3))
		{
			$choice3 = [];
		}

		$choice3 = self::fix_choice($choice3);


		$all_choice = array_merge($choice1, $choice2, $choice3);
		$all_choice = array_values($all_choice);


		$result = \lib\db\form_answerdetail\get::advance_chart($form_id, $q1_id, $q2_id, $q3_id);

		if(!is_array($result))
		{
			$result = [];
		}

		$ready = [];

		$ready[] =
		[
			'id'     => "0.0",
			'name'   => T_("All"),
			'parent' => null,
			'value'  => null,
		];

		foreach ($choice1 as $key1 => $value1)
		{
			$ready[] =
			[
				'id'     => "1.$key1",
				'name'   => $value1,
				'parent' => '0.0',
				'value'  => null,
			];

			foreach ($choice2 as $key2 => $value2)
			{
				$ready[] =
				[
					'id'     => "2.$key1.$key2",
					'name'   => $value2,
					'parent' => "1.$key1",
					'value'  => null,
				];

				if($choice3)
				{
					foreach ($choice3 as $key3 => $value3)
					{
						$ready[] =
						[
							'id'     => "3.$key1.$key2.$key3",
							'name'   => $value3,
							'parent' => "2.$key1.$key2",
							'value'  => null,
						];
					}
				}
			}
		}


		$count_answer = array_sum(array_column($result, 'count'));

		if(!$count_answer)
		{
			$count_answer = 1;
		}

		$ready_key = array_column($ready, 'id');


		$ready_table = [];
		foreach ($result as $key => $value)
		{
			$temp_table = [];
			$temp_table['q1'] = $value['q1'];

			if($q3)
			{
				$check_key = array_search("3.$value[q1].$value[q2].$value[q3]", $ready_key);
				$temp_table['q2'] = $value['q2'];
				$temp_table['q3'] = $value['q3'];
			}
			else
			{
				$check_key = array_search("2.$value[q1].$value[q2]", $ready_key);

				$temp_table['q2'] = $value['q2'];
			}

			$percent = 0;
			if($check_key !== false)
			{
				$percent = round((intval($value['count']) * 100)/ $count_answer);
				$ready[$check_key]['value'] = $percent;
				// $ready[$check_key]['value'] = intval($value['count']);
			}

			$temp_table['count'] = $value['count'];
			$temp_table['percent'] = $percent;

			$ready_table[] = $temp_table;
		}

		// var_dump($ready);exit();

		// $new_ready = [];
		// foreach ($ready as $key => $value)
		// {
		// 	$id = $value['id'];
		// 	$explode = explode('.', $id);
		// 	$new_id = [];
		// 	foreach ($explode as $split_id)
		// 	{
		// 		if(is_numeric($split_id))
		// 		{
		// 			$new_id[] = $split_id;
		// 		}
		// 		else
		// 		{
		// 			$new_id[] = '1'. array_search($split_id, $all_choice);
		// 		}
		// 	}
		// 	$new_id = implode('.', $new_id);
		// 	$value['id'] = $new_id;

		// 	$parent = $value['parent'];
		// 	$explode = explode('.', $parent);
		// 	$new_parent = [];
		// 	foreach ($explode as $split_parent)
		// 	{
		// 		if(is_numeric($split_parent))
		// 		{
		// 			$new_parent[] = $split_parent;
		// 		}
		// 		else
		// 		{
		// 			$new_parent[] = '1'. array_search($split_parent, $all_choice);
		// 		}
		// 	}
		// 	$new_parent = implode('.', $new_parent);
		// 	$value['parent'] = $new_parent;

		// 	$new_ready[] = $value;
		// }
		// // var_dump($ready, $new_ready);exit();


		// $ready = $new_ready;

		// var_dump($ready);exit();

		$ready        = json_encode($ready, JSON_UNESCAPED_UNICODE);

		$table = [];


		// array_multisort($table, $result_sort, $my_order | $my_sort_detail);
		// array_multisort($table, $result_sort, SORT_DESC | SORT_NUMERIC);

		$return             = [];
		$return['chart']    = $ready;
		$return['data_table'] = $ready_table;
		// var_dump($return);exit();

		return $return;


	}
}
?>