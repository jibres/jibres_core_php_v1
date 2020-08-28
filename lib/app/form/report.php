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
}
?>