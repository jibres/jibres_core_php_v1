<?php
namespace lib\app\store;


class analytics
{
	public static function field_list()
	{

		$field_list =
		[
			// 'lastactivity'      => ['group' => T_("Other"), 'title' => T_('lastactivity')],
			// 'lastchangesetting' => ['group' => T_("Other"), 'title' => T_('lastchangesetting')],
			// 'lastadminlogin'    => ['group' => T_("Other"), 'title' => T_('lastadminlogin')],
			// 'laststafflogin'    => ['group' => T_("Other"), 'title' => T_('laststafflogin')],
			// 'lastsale'          => ['group' => T_("Other"), 'title' => T_('lastsale')],
			// 'lastbuy'           => ['group' => T_("Other"), 'title' => T_('lastbuy')],
			// 'dbtrafic'          => ['group' => T_("Other"), 'title' => T_('Database traffic')],
			// 'session'           => ['group' => T_("Other"), 'title' => T_('Session')],
			// 'planhistory'       => ['group' => T_("Other"), 'title' => T_('Plan history')],
			// 'datecreated'       => ['group' => T_("Other"), 'title' => T_('datecreated')],
			// 'datemodified'      => ['group' => T_("Other"), 'title' => T_('datemodified')],
			//
			'dbsize'               => ['group' => T_("Database"), 'title' => T_('Database Size'), 'important' => true,],

			'users'                => ['group' => T_("Users"), 'title' => T_('Users') , 'important' => true,],
			'customer'             => ['group' => T_("Users"), 'title' => T_('Customer')],
			'staff'                => ['group' => T_("Users"), 'title' => T_('Staff')],
			'comment'              => ['group' => T_("Users"), 'title' => T_('Comment')],
			'address'              => ['group' => T_("Users"), 'title' => T_('Address')],
			'user_mobile'          => ['group' => T_("Users"), 'title' => T_('User mobile')],
			'user_email'           => ['group' => T_("Users"), 'title' => T_('User email')],
			'user_chatid'          => ['group' => T_("Users"), 'title' => T_('User chatid')],
			'user_username'        => ['group' => T_("Users"), 'title' => T_('User username')],
			'user_android'         => ['group' => T_("Users"), 'title' => T_('User android')],
			'user_awaiting'        => ['group' => T_("Users"), 'title' => T_('User awaiting')],
			'user_removed'         => ['group' => T_("Users"), 'title' => T_('User removed')],
			'user_filter'          => ['group' => T_("Users"), 'title' => T_('User filter')],
			'user_unreachabl'      => ['group' => T_("Users"), 'title' => T_('User unreachabl')],
			'user_permission'      => ['group' => T_("Users"), 'title' => T_("User with permission")],
			'user_auth'            => ['group' => T_("Users"), 'title' => T_("User auth")],
			'user_telegram'        => ['group' => T_("Users"), 'title' => T_("User telegram")],
			'userdetail'           => ['group' => T_("Users"), 'title' => T_("Userdetail")],
			'userlegal'            => ['group' => T_("Users"), 'title' => T_("Userlegal")],
			'telegrams'            => ['group' => T_("Users"), 'title' => T_("Telegrams")],


			'ticket'               => ['group' => T_("Support"), 'title' => T_('Ticket')],
			'ticket_message'       => ['group' => T_("Support"), 'title' => T_('Ticket_message')],
			'help'                 => ['group' => T_("Support"), 'title' => T_('Help center article')],
			'support_tag'          => ['group' => T_("Support"), 'title' => T_('Support tag')],
			'help_tag'             => ['group' => T_("Support"), 'title' => T_('Help tag')],


			'news'                 => ['group' => T_("CMS"), 'title' => T_('News')],
			'page'                 => ['group' => T_("CMS"), 'title' => T_('Page')],
			'post'                 => ['group' => T_("CMS"), 'title' => T_('Post')],
			'term'                 => ['group' => T_("CMS"), 'title' => T_('Term')],
			'termusages'           => ['group' => T_("CMS"), 'title' => T_('Term usages')],
			'attachment'           => ['group' => T_("CMS"), 'title' => T_('Attachment')],
			'tag'                  => ['group' => T_("CMS"), 'title' => T_('Tag')],
			'cat'                  => ['group' => T_("CMS"), 'title' => T_('Cat')],


			'product'              => ['group' => T_("Product"), 'title' => T_('Product'), 'important' => true,],
			'inventory'            => ['group' => T_("Product"), 'title' => T_("Inventory")],
			'productcategory'      => ['group' => T_("Product"), 'title' => T_("Product category")],
			'productcategoryusage' => ['group' => T_("Product"), 'title' => T_("Product categoryusage")],
			'productcomment'       => ['group' => T_("Product"), 'title' => T_("Product comment")],
			'productcompany'       => ['group' => T_("Product"), 'title' => T_("Product company")],
			'productinventory'     => ['group' => T_("Product"), 'title' => T_("Product inventory")],
			'productprices'        => ['group' => T_("Product"), 'title' => T_("Product prices")],
			'productproperties'    => ['group' => T_("Product"), 'title' => T_("Product properties")],
			'producttag'           => ['group' => T_("Product"), 'title' => T_("Product tag")],
			'producttagusage'      => ['group' => T_("Product"), 'title' => T_("Product tagusage")],
			'productunit'          => ['group' => T_("Product"), 'title' => T_("Product unit")],


			'factor'               => ['group' => T_("Factors"), 'title' => T_('Factor'), 'important' => true,],
			'factorbuy'            => ['group' => T_("Factors"), 'title' => T_('Factor buy')],
			'factorsale'           => ['group' => T_("Factors"), 'title' => T_('Factor sale')],
			'factordetail'         => ['group' => T_("Factors"), 'title' => T_('Factor detail')],
			'sumfactor'            => ['group' => T_("Factors"), 'title' => T_('Sum factor')],
			'factoraction'         => ['group' => T_("Factors"), 'title' => T_("Factor action")],
			'factoraddress'        => ['group' => T_("Factors"), 'title' => T_("Factor address")],

			'cart'                 => ['group' => T_("Factors"), 'title' => T_('Cart'), 'important' => true,],


			'transaction'          => ['group' => T_("Transaction"), 'title' => T_('Transaction'), 'important' => true,],
			'sumplustransaction'   => ['group' => T_("Transaction"), 'title' => T_('Sum plus transaction')],
			'summinustransaction'  => ['group' => T_("Transaction"), 'title' => T_('Sum minus transaction')],

			'tax_coding'           => ['group' => T_("Accounting"), 'title' => T_("Tax coding")],
			'tax_docdetail'        => ['group' => T_("Accounting"), 'title' => T_("Tax docdetail")],
			'tax_document'         => ['group' => T_("Accounting"), 'title' => T_("Tax document"), 'important' => true,],
			'tax_year'             => ['group' => T_("Accounting"), 'title' => T_("Tax year")],
			'ir_vat'               => ['group' => T_("Accounting"), 'title' => T_("IR vat")],


			'log'                  => ['group' => T_("Log"), 'title' => T_('Log')],
			'sync'                 => ['group' => T_("Log"), 'title' => T_('Sync')],
			'apilog'               => ['group' => T_("Log"), 'title' => T_('Api log')],
			'csrf'                 => ['group' => T_("Log"), 'title' => T_("Csrf")],
			'dayevent'             => ['group' => T_("Log"), 'title' => T_("Day event")],


			'form'                 => ['group' => T_("Forms"), 'title' => T_("Form"), 'important' => true,],
			'form_answer'          => ['group' => T_("Forms"), 'title' => T_("Form answer")],
			'form_answerdetail'    => ['group' => T_("Forms"), 'title' => T_("Form answerdetail")],
			'form_choice'          => ['group' => T_("Forms"), 'title' => T_("Form choice")],
			'form_filter'          => ['group' => T_("Forms"), 'title' => T_("Form filter")],
			'form_filter_where'    => ['group' => T_("Forms"), 'title' => T_("Form filter where")],
			'form_item'            => ['group' => T_("Forms"), 'title' => T_("Form item")],


			'app_download'         => ['group' => T_("Other"), 'title' => T_("Application downloads")],
			'funds'                => ['group' => T_("Other"), 'title' => T_("Funds")],
			'files'                => ['group' => T_("Other"), 'title' => T_("Files")],
			'fileusage'            => ['group' => T_("Other"), 'title' => T_("Fileusage")],
			'importexport'         => ['group' => T_("Other"), 'title' => T_("Import Export")],
			'log_notif'            => ['group' => T_("Other"), 'title' => T_("Log notif")],
			'login'                => ['group' => T_("Other"), 'title' => T_("Login")],
			'login_ip'             => ['group' => T_("Other"), 'title' => T_("Login ip")],
			'setting'              => ['group' => T_("Other"), 'title' => T_("Setting"), 'important' => true,],
			'pos'                  => ['group' => T_("Other"), 'title' => T_("POS")],



			'urls'                 => ['group' => T_("Visitors"), 'title' => T_("Urls")],
			'visitors'             => ['group' => T_("Visitors"), 'title' => T_("Visitors")],
			'agent'                => ['group' => T_("Visitors"), 'title' => T_('Agent')],


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