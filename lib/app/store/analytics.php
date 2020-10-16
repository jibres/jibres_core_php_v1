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
			'dbtrafic'            => ['title' => T_('Database traffic')],
			'dbsize'              => ['title' => T_('Database Size')],
			'users'               => ['title' => T_('Users')],
			'customer'            => ['title' => T_('Customer')],
			'staff'               => ['title' => T_('Staff')],
			'agent'               => ['title' => T_('Agent')],
			'session'             => ['title' => T_('Session')],
			'ticket'              => ['title' => T_('Ticket')],
			'ticket_message'      => ['title' => T_('Ticket_message')],
			'comment'             => ['title' => T_('Comment')],
			'address'             => ['title' => T_('Address')],
			'news'                => ['title' => T_('News')],
			'page'                => ['title' => T_('Page')],
			'post'                => ['title' => T_('Post')],
			'transaction'         => ['title' => T_('Transaction')],
			'term'                => ['title' => T_('Term')],
			'termusages'          => ['title' => T_('Term usages')],
			'sumplustransaction'  => ['title' => T_('Sum plus transaction')],
			'summinustransaction' => ['title' => T_('Sum minus transaction')],
			'product'             => ['title' => T_('Product')],
			'factor'              => ['title' => T_('Factor')],
			'factorbuy'           => ['title' => T_('Factor buy')],
			'factorsale'          => ['title' => T_('Factor sale')],
			'factordetail'        => ['title' => T_('Factor detail')],
			'sumfactor'           => ['title' => T_('Sum factor')],
			'planhistory'         => ['title' => T_('Plan history')],
			'help'                => ['title' => T_('Help center article')],
			'attachment'          => ['title' => T_('Attachment')],
			'tag'                 => ['title' => T_('Tag')],
			'cat'                 => ['title' => T_('Cat')],
			'support_tag'         => ['title' => T_('Support tag')],
			'help_tag'            => ['title' => T_('Help tag')],
			'user_mobile'         => ['title' => T_('User mobile')],
			'user_email'          => ['title' => T_('User email')],
			'user_chatid'         => ['title' => T_('User chatid')],
			'user_username'       => ['title' => T_('User username')],
			'user_android'        => ['title' => T_('User android')],
			'user_awaiting'       => ['title' => T_('User awaiting')],
			'user_removed'        => ['title' => T_('User removed')],
			'user_filter'         => ['title' => T_('User filter')],
			'user_unreachabl'     => ['title' => T_('User unreachabl')],
			'user_permission'     => ['title' => T_('User permission')],
			// 'datecreated'         => ['title' => T_('datecreated')],
			// 'datemodified'        => ['title' => T_('datemodified')],
			'log'                 => ['title' => T_('Log')],
			'cart'                => ['title' => T_('Cart')],
			'sync'                => ['title' => T_('Sync')],
			'apilog'              => ['title' => T_('Api log')],
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