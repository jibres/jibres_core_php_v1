<?php
namespace lib\app\store;


class timeline
{
	private static $key = 'store_timeline';


	public static function clean()
	{
		\dash\session::clean(self::$key);
	}

	public static function set_store_id($_store_id)
	{
		// set store id in field list
		$session = [];
		if(\dash\session::get(self::$key))
		{
			$session = \dash\session::get(self::$key);
		}

		if(!is_array($session))
		{
			$session = [];
		}

		$_store_id = \dash\validate::id($_store_id);

		if(isset($session['id']) && $_store_id)
		{
			\lib\db\store\timeline::set_store_id($session['id'], $_store_id);
			self::clean();
		}
	}


	private static function start()
	{
		if(!\dash\session::get(self::$key))
		{
			$session = [];
			if(isset($_SESSION['auth']['logintime']))
			{
				$session['login'] = date("Y-m-d H:i:s", $_SESSION['auth']['logintime']);
				$session['login_diff'] = time() - intval($_SESSION['auth']['logintime']);
				if(intval($session['login_diff']) > 99999999)
				{
					$session['login_diff'] = 99999999;
				}
			}

			$session['start'] = date("Y-m-d H:i:s");

			$timeline_id = \lib\db\store\timeline::insert($session);

			if($timeline_id)
			{
				$session['id'] = $timeline_id;
			}

			\dash\session::set(self::$key, $session);
		}
	}


	public static function set($_module, $_store_id = null)
	{
		switch ($_module)
		{
			case 'start':
				self::start();
				break;

			case 'ask':
				self::set_module_time($_module, 'start', $_store_id);
				break;

			case 'subdomain':
				self::set_module_time($_module, 'ask', $_store_id);
				break;

			case 'creating':
				self::set_module_time($_module, 'subdomain', $_store_id);
				break;

			case 'startcreate':
				self::set_module_time($_module, 'creating', $_store_id);
				break;

			case 'endcreate':
				self::set_module_time($_module, 'startcreate', $_store_id);
				break;

			case 'opening':
				self::set_module_time($_module, 'endcreate', $_store_id);
				break;

			case 'loadstore':
				self::set_module_time($_module, 'opening', $_store_id);
				break;

			default:
				self::set_module_time($_module, null, $_store_id);
				break;
		}
	}


	public static function set_module_time($_current_module, $_prev_module = null, $_store_id = null)
	{
		$allow_field =
		[
			'store_id','login','login_diff','start','start_diff','ask','ask_diff','subdomain','subdomain_diff','creating',
			'creating_diff','startcreate','startcreate_diff','endcreate','endcreate_diff','opening','opening_diff','loadstore',
			'loadstore_diff','user','productcompany','productunit','products','factors','factordetails','funds','inventory',
			'productcategory','productcomment','productprices','productproperties','producttag','producttagusage','files','fileusage',
			'agents','apilog',
		];

		$_store_id = \dash\validate::id($_store_id);
		if($_store_id)
		{
			if(in_array($_current_module, $allow_field))
			{
				$update_by_store_id =
				[
					$_current_module => date("Y-m-d H:i:s"),
				];

				if($_prev_module)
				{
					$prev_module_time = \lib\db\store\timeline::get_by_store_id($_store_id);
					if(isset($prev_module_time[$_prev_module]) && is_numeric($prev_module_time[$_prev_module]))
					{
						$update_by_store_id[$_prev_module. '_diff'] = time() - strtotime($prev_module_time[$_prev_module]);
					}
				}

				\lib\db\store\timeline::update_by_store_id($update_by_store_id, $_store_id);
				return true;
			}
			return false;
		}

		$session = [];
		if(\dash\session::get(self::$key))
		{
			$session = \dash\session::get(self::$key);
		}

		if(!is_array($session))
		{
			$session = [];
		}

		// if(!isset($session[$_current_module]))
		// {
			$session[$_current_module] = date("Y-m-d H:i:s");

			if($_prev_module)
			{
				if(isset($session[$_prev_module]))
				{
					$session[$_prev_module. '_diff'] = time() - strtotime($session[$_prev_module]);
				}
			}

			if(isset($session['id']))
			{
				$update = [];

				foreach ($session as $key => $value)
				{
					if(in_array($key, $allow_field))
					{
						$update[$key] = $value;
					}
				}

				\lib\db\store\timeline::update($update, $session['id']);
			}

			\dash\session::set(self::$key, $session);
		// }
	}

}
?>