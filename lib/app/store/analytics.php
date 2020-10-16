<?php
namespace lib\app\store;


class analytics
{
	public static function field_list()
	{

		$field_list =
		[
			// 'lastactivity'        => ['title' => T_('lastactivity')],
			// 'lastchangesetting'   => ['title' => T_('lastchangesetting')],
			// 'lastadminlogin'      => ['title' => T_('lastadminlogin')],
			// 'laststafflogin'      => ['title' => T_('laststafflogin')],
			// 'lastsale'            => ['title' => T_('lastsale')],
			// 'lastbuy'             => ['title' => T_('lastbuy')],
			'dbtrafic'            => ['title' => T_('dbtrafic')],
			'dbsize'              => ['title' => T_('dbsize')],
			'users'               => ['title' => T_('users')],
			'customer'            => ['title' => T_('customer')],
			'staff'               => ['title' => T_('staff')],
			'agent'               => ['title' => T_('agent')],
			'session'             => ['title' => T_('session')],
			'ticket'              => ['title' => T_('ticket')],
			'ticket_message'      => ['title' => T_('ticket_message')],
			'comment'             => ['title' => T_('comment')],
			'address'             => ['title' => T_('address')],
			'news'                => ['title' => T_('news')],
			'page'                => ['title' => T_('page')],
			'post'                => ['title' => T_('post')],
			'transaction'         => ['title' => T_('transaction')],
			'term'                => ['title' => T_('term')],
			'termusages'          => ['title' => T_('termusages')],
			'sumplustransaction'  => ['title' => T_('sumplustransaction')],
			'summinustransaction' => ['title' => T_('summinustransaction')],
			'product'             => ['title' => T_('product')],
			'factor'              => ['title' => T_('factor')],
			'factorbuy'           => ['title' => T_('factorbuy')],
			'factorsale'          => ['title' => T_('factorsale')],
			'factordetail'        => ['title' => T_('factordetail')],
			'sumfactor'           => ['title' => T_('sumfactor')],
			'planhistory'         => ['title' => T_('planhistory')],
			'help'                => ['title' => T_('help')],
			'attachment'          => ['title' => T_('attachment')],
			'tag'                 => ['title' => T_('tag')],
			'cat'                 => ['title' => T_('cat')],
			'support_tag'         => ['title' => T_('support_tag')],
			'help_tag'            => ['title' => T_('help_tag')],
			'user_mobile'         => ['title' => T_('user_mobile')],
			'user_email'          => ['title' => T_('user_email')],
			'user_chatid'         => ['title' => T_('user_chatid')],
			'user_username'       => ['title' => T_('user_username')],
			'user_android'        => ['title' => T_('user_android')],
			'user_awaiting'       => ['title' => T_('user_awaiting')],
			'user_removed'        => ['title' => T_('user_removed')],
			'user_filter'         => ['title' => T_('user_filter')],
			'user_unreachabl'     => ['title' => T_('user_unreachabl')],
			'user_permission'     => ['title' => T_('user_permission')],
			// 'datecreated'         => ['title' => T_('datecreated')],
			// 'datemodified'        => ['title' => T_('datemodified')],
			'log'                 => ['title' => T_('log')],
			'cart'                => ['title' => T_('cart')],
			'sync'                => ['title' => T_('sync')],
			'apilog'              => ['title' => T_('apilog')],
		];

		return $field_list;

	}


	public static function summary()
	{
		$field_list = self::field_list();

		$get_summary = \lib\db\store_analytics\get::summary($field_list);
		foreach ($get_summary as $key => $value)
		{
			$field = substr($key, 4);
			if(isset($field_list[$field]))
			{
				$field_list[$field][substr($key, 0, 3)] = $value;
			}
		}

		return $field_list;
	}




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