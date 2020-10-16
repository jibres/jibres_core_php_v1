<?php
namespace lib\app\store;


class analytics
{


	public static function average_creating_time()
	{
		$time = \lib\db\store_analytics\get::average_creating_time();
		return $time;
	}


	public static function answer_question()
	{
		$answer = \lib\db\store_analytics\get::answer_question();
		$answer = array_map('floatval', $answer);

		$total_answer_skip =
		[
			['y' => $answer['som_answer'], 'name' => T_("Answered")],
			['y' => $answer['skip_all'], 'name' => T_("Skipped")],
		];

		$answer['chart_skip_answer'] = json_encode($total_answer_skip, JSON_UNESCAPED_UNICODE);

		$polls = \lib\app\store\polls::all();

		$chart_q1 = [];
		$chart_q2 = [];
		$chart_q3 = [];

		$chart_q1_raw = \lib\db\store_analytics\get::chart_question(1);
		$chart_q2_raw = \lib\db\store_analytics\get::chart_question(2);
		$chart_q3_raw = \lib\db\store_analytics\get::chart_question(3);

		foreach ($polls['questions'] as $key => $value)
		{
			if(isset($value['id']))
			{
				$index = substr($value['id'], 1);
				if(in_array($index, [1,2,3]))
				{
					$q = \lib\db\store_analytics\get::chart_question($index);

					$chart = [];
					$chart['title'] = $value['title'];
					$chart['data'] = [];

					foreach ($value['items'] as $k => $v)
					{
						$y = 0;
						if(isset($q[$k]))
						{
							$y = floatval($q[$k]);
						}

						$chart['data'][] = ['name' => $v, 'y' => $y];
					}

					$chart['data'] = json_encode($chart['data'], JSON_UNESCAPED_UNICODE);

					$answer['chart_q'. $index] = $chart;
				}

			}
		}


		// var_dump($answer);exit();
		return $answer;
	}



}
?>