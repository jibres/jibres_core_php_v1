<?php
namespace dash\app;

class ticket
{

	public static $sort_field =
	[
		'id',
		'plus',
		'minus',
		'datecreated',
		'status',
		'mobile',
		// 'author',
		'email',
	];

	public static $public_show_field =
				"
					tickets.*,
					users.avatar,
					users.firstname,
					users.mobile,
					users.displayname
				 ";
	public static $master_join = "LEFT JOIN users ON users.id = tickets.user_id ";



	public static function get_user_in_ticket($_ticket_detail)
	{
		if(!is_array($_ticket_detail))
		{
			return false;
		}

		$ids = array_column($_ticket_detail, 'id');
		if(!is_array($ids) || empty($ids) || !$ids)
		{
			return false;
		}
		$ids = array_unique($ids);
		$ids = array_filter($ids);

		if(empty($ids))
		{
			return false;
		}

		$ids         = implode(',', $ids);
		$user_detail = \dash\db\tickets::get_user_in_ticket($ids);

		if(is_array($user_detail))
		{
			$user_detail = array_map(['\dash\app\user', 'ready'], $user_detail);
		}

		$user_detail = array_combine(array_column($user_detail, 'id'), $user_detail);

		foreach ($_ticket_detail as $key => $value)
		{
			if(isset($value['user_in_ticket']) && is_array($value['user_in_ticket']))
			{
				$user_in_ticket_detail = [];

				foreach ($value['user_in_ticket'] as $k => $v)
				{
					if(isset($value['user_id']) && $value['user_id'] === $v)
					{
						continue;
					}
					if(array_key_exists($v, $user_detail))
					{
						$user_in_ticket_detail[] = $user_detail[$v];
					}
				}
				$_ticket_detail[$key]['user_in_ticket_detail'] = $user_in_ticket_detail;
			}
		}

		return $_ticket_detail;
	}

	private static function chart_ticket_day()
	{
		$day = [];
		for ($i=1; $i <= 365 ; $i++)
		{
			$day[] = \dash\datetime::fit(date("Y-m-d", strtotime("-$i days")), false, "date");
		}
		return $day;
	}

	private static function count_ticket($_type)
	{
		$result = [];
		if($_type === 'ticket')
		{
			$count = \dash\db\tickets\report::count_ticket();
		}
		elseif($_type === 'message')
		{
			$count = \dash\db\tickets\report::count_message();
		}
		else
		{
			$count = \dash\db\tickets\report::avg_time();
		}

		$count = array_combine(array_column($count, 'date'), array_column($count, 'count'));

		if(is_array($count))
		{
			$last_date = date("Y-m-d", strtotime("-365 days"));

			$i = 0;

			foreach ($count as $date => $count)
			{

				$date1 = date_create($last_date);
				$date2 = date_create($date);
				$diff  = date_diff($date2, $date1);
				$days  = 0;

				if(isset($diff->days))
				{
					$days = $diff->days;
				}

				if($days)
				{
					while ($days)
					{
						$days--;

						if($days)
						{
							$newDate = date("Y-m-d", strtotime($last_date) + ($days * (60*60*24)));
							$result[$newDate] = 0;
						}
					}

					$result[$date] = intval($count);
				}
				else
				{
					$result[$date] = intval($count);
				}

				$last_date = $date;
			}
		}


		ksort($result);


		return array_values($result);

	}



	public static function chart_ticket()
	{
		$result               = [];
		$result['xData']      = self::chart_ticket_day();
		$result['datasets']   = [];
		$result['datasets'][] =
		[
			"name"          => T_("Count ticket"),
			"data"          => self::count_ticket('ticket'),
			"unit"          => T_("Ticket"),
			"type"          => "line",
			"valueDecimals" => 0
		];

		$result['datasets'][] =
		[
			"name"          => T_("Count message"),
			"data"          => self::count_ticket('message'),
			"unit"          => T_("Message"),
			"type"          => "area",
			"valueDecimals" => 0
		];

		$result['datasets'][] =
		[
			"name"          => T_("Answer time"),
			"data"          => self::count_ticket('avg_time'),
			"unit"          => T_("Minutes"),
			"type"          => "area",
			"valueDecimals" => 0
		];

		$result = json_encode($result, JSON_UNESCAPED_UNICODE);
		return $result;
	}

	public static function last_month_count()
	{
		$result = \dash\db\tickets\report::last_month_count();

		if(!is_array($result))
		{
			$result = [];
		}

		$day   = array_column($result, 'day');
		$value = array_column($result, 'count');
		$value = array_map('intval', $value);

		$hi_chart               = [];
		$hi_chart['categories'] = json_encode($day, JSON_UNESCAPED_UNICODE);
		$hi_chart['value']      = json_encode($value, JSON_UNESCAPED_UNICODE);
		return $hi_chart;
	}


	public static function get($_id)
	{

		$_id = \dash\validate::id($_id);

		if(!$_id || !is_numeric($_id))
		{
			return false;
		}

		$_options['public_show_field'] = self::$public_show_field;

		$_options['master_join'] = self::$master_join;

		$get = \dash\db\tickets::get(['tickets.id' => $_id, 'limit' => 1], $_options);

		if(is_array($get))
		{
			return self::ready($get);
		}
		return false;
	}


	public static function add($_args)
	{


		// check args
		$args = self::check($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}


		if(isset($args['user_id']) && is_numeric($args['user_id']))
		{
			$check_duplicate =
			[
				'user_id' => $args['user_id'],
				'content' => $args['content'],
				'limit'   => 1,
			];

			if(isset($args['parent']) && $args['parent'])
			{
				$check_duplicate['parent'] = $args['parent'];
			}

			$check_duplicate = \dash\db\tickets::get($check_duplicate);

			if(isset($check_duplicate['id']))
			{
				\dash\notif::error(T_("This text is duplicate and you are sended something like this before!"), 'content');
				return false;
			}
		}

		$dateNow = date("Y-m-d H:i:s");

		$args['visitor_id']  = \dash\utility\visitor::id();
		$args['ip']          = \dash\server::ip(true);
		$args['datecreated'] = $dateNow;


		$ticket_id = \dash\db\tickets::insert($args);

		if(!$ticket_id)
		{
			\dash\notif::error(T_("No way to add new data"));
			return false;
		}

		$return            = [];
		$return['id']      = $ticket_id;
		$return['date']    = $dateNow;
		$return['code']    = md5((string) $ticket_id. '^_^-*_*)JIBRES));))__'. $dateNow);
		$return['codeurl'] = \dash\url::kingdom(). '/support/ticket/show?id='. $return['id']. '&guest='. $return['code'];
		return $return;
	}


	public static function edit($_args, $_id)
	{

		$_id = \dash\validate::id($_id);

		if(!$_id || !is_numeric($_id))
		{
			\dash\notif::error(T_("Can not access to edit ticket"));
			return false;
		}

		$args = self::check($_args, $_id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		if($args)
		{
			\dash\log::set('editComment', ['code' => $_id]);

			return \dash\db\tickets::update($args, $_id);
		}
	}



	public static function list($_string = null, $_args = [])
	{

		$default_meta =
		[
			'pagenation' => true,
			'sort'       => null,
			'order'      => null,
			'join_user'  => false,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default_meta, $_args);

		if($_args['sort'] && !in_array($_args['sort'], self::$sort_field))
		{
			$_args['sort'] = null;
		}

		$_string = \dash\validate::search($_string);

		$result            = \dash\db\tickets::search($_string, $_args);
		$temp              = [];

		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$check = \dash\app::fix_avatar($check);
				$temp[] = $check;
			}
		}

		return $temp;
	}


	public static function check($_args, $_id = null)
	{

		$content_condition = 'desc';

		if(\dash\permission::check('supportTicketSignature'))
		{
			$content_condition = 'html';
		}

		$condition =
		[
			'title'   => 'title',
			'status'  => ['enum' => ['approved','awaiting','unapproved','spam','deleted','filter','close', 'answered']],
			'via'     => ['enum' => ['site', 'telegram', 'sms', 'contact', 'admincontact', 'app']],
			'type'    => 'string_50',
			'user_id' => 'id',
			'file'    => 'string',
			'content' => $content_condition,
			'parent'  => 'id',
		];

		$require = ['content'];
		$meta    = [];

		$data    = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}


	/**
	 * ready data of classroom to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'ip':
					if($value)
					{
						$result['prettyip'] = \dash\fit::number(long2ip($value));
					}
					$result[$key] = $value;
					break;

				case 'status':
					$color       = null;
					$color_class = null;
					switch ($value)
					{
						case 'awaiting':
							$color       = null;
							$color_class = 'pain';
							break;

						case 'unapproved':
							$color       = 'warning';
							$color_class = 'warn';
							break;

						case 'spam':
						case 'deleted':
						case 'filter':
							$color       = 'negative';
							$color_class = 'danger';
							break;

						case 'close':
							$color       = 'disabled';
							$color_class = 'secondary';
							break;

						case 'answered':
							$color       = 'positive';
							$color_class = 'success';
							break;
					}

					if(isset($_data['plus']) && $_data['plus'])
					{
						if($value === 'awaiting')
						{
							$color = 'active';
						}
					}

					$result['rowColor']   = $color;
					$result['colorClass'] = $color_class;
					$result[$key]         = $value;
					break;
				case 'id':
					$result[$key] = $value;
					$datecreated = isset($_data['datecreated']) ? $_data['datecreated'] : null;
					if($datecreated)
					{
						$result['code'] =  md5((string) $value. '^_^-*_*)JIBRES));))__'. $datecreated);
					}
					break;

				case 'user_in_ticket':
					if($value)
					{
						$explode = explode(',', $value);
						$result[$key] = array_map(['\dash\coding', 'encode'], $explode);
					}
					else
					{
						$result[$key] = [];
					}
					break;
				case 'user_id':
				case 'term_id':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'avatar':
				case 'file':
					if(isset($value))
					{
						$result[$key] = \lib\filepath::fix($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}
}
?>