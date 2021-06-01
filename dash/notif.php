<?php
namespace dash;
/**
 * Class for notif.
 */
class notif
{
	private static $notif = [];


	private static function add($_type, $_text, $_meta)
	{
		self::$notif['ok'] = \dash\engine\process::status();

		if(!isset(self::$notif['msg']))
		{
			self::$notif['msg'] = [];
		}

		$add =
		[
			'type' => $_type,
			'text' => $_text,
		];

		if($_meta)
		{
			if(is_string($_meta))
			{
				$_meta = ['element' => $_meta];
			}

			$add['meta'] = $_meta;
		}

		// self::log_notif($add);

		array_push(self::$notif['msg'], $add);
	}


	/**
	 * Add notif if have not another notif by this type
	 *
	 * @param      <type>   $_type  The type
	 * @param      <type>   $_text  The text
	 * @param      <type>   $_meta  The meta
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	private static function add_once($_type, $_text, $_meta)
	{
		if(isset(self::$notif['msg']) && is_array(self::$notif['msg']))
		{
			foreach (self::$notif['msg'] as $key => $value)
			{
				if(isset($value['type']) && $value['type'] === $_type)
				{
					return false;
				}
			}
		}

		return self::add($_type, $_text, $_meta);
	}


	/**
	 * Save log notif
	 *
	 * @var        boolean
	 */
	private static $notif_log_status = true;

	public static function turn_off_log()
	{
		self::$notif_log_status = false;
	}

	public static function turn_on_log()
	{
		self::$notif_log_status = true;
	}

	private static function log_notif($_add)
	{
		if(\dash\url::content() === 'hook')
		{
			return;
		}

		if(!self::$notif_log_status)
		{
			return;
		}

		$insert = [];

		$insert['type']        = isset($_add['type']) ? addslashes($_add['type']): null;
		$insert['message']     = isset($_add['text']) ? addslashes($_add['text']): null;
		$insert['messagemd5']  = md5($insert['message']);
		$insert['meta']        = isset($_add['meta']) ? json_encode($_add['meta'], JSON_UNESCAPED_UNICODE): null;
		$insert['method']      = addslashes(\dash\request::is());
		$insert['user_id']     = null;
		$insert['urlkingdom']  = addslashes(\dash\url::kingdom());
		$insert['urldir']      = addslashes(\dash\url::directory());
		$insert['urlquery']    = addslashes(\dash\url::query());
		$insert['datecreated'] = date("Y-m-d H:i:s");

		\dash\db\log_notif\insert::new_record($insert);
	}


	private static function add_detail($_key, $_value)
	{
		self::$notif['ok']  = \dash\engine\process::status();
		self::$notif[$_key] = $_value;
	}


	public static function info($_text, $_meta = [])
	{
		self::add('info', $_text, $_meta);
	}


	public static function ok($_text, $_meta = [])
	{
		self::add('ok', $_text, $_meta);
	}


	public static function debug($_data)
	{
		self::add_detail('debug', $_data);
	}

	public static function create($_text, $_meta = [])
	{
		\dash\header::set(201);
		self::add('ok', $_text, $_meta);
	}


	public static function update($_text, $_meta = [])
	{
		\dash\header::set(202);
		self::add('ok', $_text, $_meta);
	}

	public static function delete($_text, $_meta = [])
	{
		// \dash\header::set(202); // if need change header status of delete request
		self::add('ok', $_text, $_meta);
	}


	public static function warn($_text, $_meta = [])
	{
		self::add('warn', $_text, $_meta);
	}


	public static function error($_text, $_meta = [])
	{
		// stop engine process
		\dash\engine\process::stop();

		self::add('error', $_text, $_meta);
	}


	public static function error_once($_text, $_meta = [])
	{
		self::add_once('error', $_text, $_meta);
	}


	public static function direct($_direct = true)
	{
		self::add_detail('direct', $_direct);
	}

	public static function live($_live = true)
	{
		self::add_detail('live', $_live);
	}


	public static function liveResult($_liveResult)
	{
		self::add_detail('liveResult', $_liveResult);
	}

	public static function liveTarget($_liveTarget)
	{
		self::add_detail('liveTarget', $_liveTarget);
	}

	public static function livePosition($_livePosition)
	{
		self::add_detail('livePosition', $_livePosition);
	}


	public static function sound($_sound = null)
	{
		if($_sound && is_string($_sound))
		{
			self::add_detail('sound', $_sound);
		}
	}


	public static function reloadIframe($_name = 'liveIframe')
	{
		self::add_detail('reloadIframe', $_name);
	}


	public static function replaceState($_replaceState = true)
	{
		self::add_detail('replaceState', $_replaceState);
	}


	public static function redirect($_url)
	{
		self::add_detail('redirect', $_url);
	}


	public static function result($_result)
	{
		self::add_detail('result', $_result);
	}

	// just for select22 - reza says
	public static function results($_result)
	{
		self::add_detail('results', $_result);
	}


	public static function api($_data = null)
	{
		self::pagination();
		if($_data)
		{
			self::result($_data);
		}
		\dash\code::jsonBoom(self::$notif, true);
	}


	public static function code($_code)
	{
		self::add_detail('code', $_code);
	}


	public static function meta($_meta)
	{
		self::add_detail('meta', $_meta);
	}


	private static function pagination()
	{
		$pagination = \dash\utility\pagination::api_detail();
		if($pagination)
		{
			self::add_detail('pagination', $pagination);
		}
	}


	public static function json()
	{
		if(count(self::$notif) > 0)
		{
			return json_encode(self::$notif);

		}
		return null;
	}


	public static function jsonHtml()
	{
		if(count(self::$notif) > 0)
		{
			return json_encode(self::$notif, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

		}
		return null;
	}


	public static function get()
	{
		return self::$notif;
	}


	public static function clean()
	{
		self::$notif = [];
	}


	public static function get_in_html()
	{
		$notif = self::get();
		if(isset($notif['msg']) && is_array($notif['msg']))
		{
			foreach ($notif['msg'] as $key => $value)
			{
				if(isset($value['type']) && isset($value['text']))
				{
					$class = null;
					switch ($value['type'])
					{
						case 'error':
							$class = 'danger2';
							break;

						case 'ok':
							$class = 'success2';
							break;
						case 'warn':
							$class = 'warn2';
							break;

						case 'info':
							// $class = 'info2';
							break;

						default:
							/*nothing*/
							break;
					}

					echo '<div class="msg '. $class. '">'. $value['text']. '</div>';
				}
			}
		}
	}
}
?>