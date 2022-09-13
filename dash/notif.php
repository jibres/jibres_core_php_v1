<?php
namespace dash;
/**
 * Class for notif.
 */
class notif
{
	private static $notif = [];
	private static $lock = false;


	/**
	 * Check active notif
	 * in some moudle need to disalbe generate notif
	 *
	 * @var        bool
	 */
	private static $active = true;


	/**
	 * Save log notif
	 *
	 * @var        boolean
	 */
	private static $notif_log_status = true;


	private static function add($_type, $_text, $_meta)
	{
		if(self::$lock)
		{
			return;
		}

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

			if(array_key_exists('element', $_meta) && $_meta['element'] === null)
			{
				// remove null element passed from somewhere
				// also we must NOT pass null value to element
				unset($_meta['element']);
			}

			// add meta if exist, because maybe we are remove null element sometimes
			if(count($_meta))
			{
				$add['meta'] = $_meta;
			}
		}

		self::log_notif($add);

		if(self::$active)
		{
			array_push(self::$notif['msg'], $add);
		}

	}


	public static function active()
	{
		self::$active = true;
	}

	public static function inactive()
	{
		self::$active = false;
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
			// return;
		}

		if(!self::$notif_log_status)
		{
			return;
		}

		$insert = [];

		$insert['type']        = a($_add, 'type');
		$insert['message']     = a($_add, 'text');
		$insert['messagemd5']  = a($insert,'message') ? md5($insert['message']) : md5('');
		$insert['meta']        = a($_add, 'meta') ? json_encode($_add['meta']) : null;
		$insert['method']      = \dash\request::is();
		$insert['user_id']     = null;
		$insert['urlkingdom']  = \dash\url::kingdom();
		$insert['urldir']      = \dash\url::directory();
		$insert['urlquery']    = \dash\url::query();
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


	public static function ok_once($_text, $_meta = [])
	{
		self::add_once('ok', $_text, $_meta);
	}


	public static function complete()
	{
		self::$notif['ok'] = \dash\engine\process::status();
	}



	public static function debug($_data)
	{
		self::add_detail('debug', $_data);
		@header("X-Debugger: pre");
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

	public static function postMsg($_data)
	{
		self::add_detail('postMsg', $_data);
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


	public static function reloadIframeSrc($_url = null)
	{
		self::add_detail('reloadIframeSrc', $_url);
	}


	public static function tada($_selector, $_html, $_replace = null)
	{
		self::add_detail('tadaSelector', $_selector);
		if($_replace)
		{
			self::add_detail('tadaReplace', $_html);
		}
		else
		{
			self::add_detail('tadaHtml', $_html);
		}
	}



	public static function replaceState($_replaceState = true)
	{
		self::add_detail('replaceState', $_replaceState);
	}


	public static function redirect($_url)
	{
		self::add_detail('redirect', $_url);
	}

	public static function redirectHeaders($_headers)
	{
		self::add_detail('redirectHeaders', $_headers);
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


	/**
	 * Append meta array
	 *
	 * @param      <type>  $_meta  The meta
	 */
	public static function meta($_meta)
	{
		$meta = [];
		if(isset(self::$notif['meta']) && is_array(self::$notif['meta']))
		{
			$meta = self::$notif['meta'];
		}

		$meta = array_merge($meta, $_meta);

		self::add_detail('meta', $meta);

	}


	private static function pagination()
	{
		$pagination = \dash\utility\pagination::api_detail();
		if($pagination)
		{
			self::add_detail('pagination', $pagination);
		}
	}


	public static function get_msg()
	{
		if(isset(self::$notif['msg']))
		{
			return self::$notif['msg'];
		}

		return [];
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


	public static function clean($_show_error = false)
	{
		if($_show_error)
		{
			if(!\dash\engine\process::status())
			{
				// not clean error
				return;
			}
		}

		if(isset(self::$notif['msg']))
		{
			self::$notif['msg'] = [];
		}
	}


	/**
	 * Only clean ok notif
	 */
	public static function clean_ok()
	{
		if(isset(self::$notif['msg']) && is_array(self::$notif['msg']))
		{
			foreach (self::$notif['msg'] as $key => $value)
			{
				if(isset($value['type']) && $value['type'] === 'ok')
				{
					unset(self::$notif['msg'][$key]);
				}
			}
		}
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
							$class = 'alert-danger';
							break;

						case 'ok':
							$class = 'alert-success';
							break;
						case 'warn':
							$class = 'alert-warn';
							break;

						case 'info':
							$class = 'alert-info';
							// $class = 'info2';
							break;

						default:
							/*nothing*/
							break;
					}

					echo '<div class="alert p-2 rounded-lg mb-1 '. $class. '">'. $value['text']. '</div>';
				}
			}
		}
	}


	public static function generate_jibres_api_notif($_result)
	{
		if(isset($_result['msg']) && is_array($_result['msg']))
		{
			foreach ($_result['msg'] as $key => $value)
			{
				if(isset($value['type']) && isset($value['text']) && in_array($value['type'], ['error','ok', 'warn','info']))
				{
					$type = $value['type'];

					\dash\notif::$type($value['text']);
				}
			}
		}
	}


	public static function lock()
	{
		self::$lock = true;
	}

	public static function unlock()
	{
		self::$lock = false;
	}

}
?>