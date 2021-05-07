<?php
namespace lib\pagebuilder\body\device;


class device
{
	// current device detail
	private static $current_device = [];


	public static function allow()
	{
		if(\dash\url::isLocal())
		{
			return true;
		}

		return false;
	}

	public static function input_condition($_args = [])
	{
		$_args['set_device'] = 'bit';
		$_args['device']     = ['enum' => ['all','desktop', 'mobile', 'other']];
		$_args['mobile']     = ['enum' => ['all','browser','pwa', 'application','other']];
		$_args['os']         = ['enum' => ['all','windows','linux', 'mac', 'android', 'other']];

		return $_args;
	}


	public static function ready_for_db($_data)
	{
		// needless to save title
		if(!a($_data, 'set_device'))
		{
			return $_data;
		}

		unset($_data['set_device']);

		return $_data;

	}


	public static function ready($_data)
	{
		if(!a($_data, 'device'))
		{
			$_data['device'] = 'all';
		}

		if(!a($_data, 'mobile'))
		{
			$_data['mobile'] = 'all';
		}


		if(!a($_data, 'os'))
		{
			$_data['os'] = 'all';
		}

		return $_data;
	}

	private static function detect_device()
	{
		$data = \dash\detect\device::data();
		self::$current_device = $data;
	}


	public static function is_ok($_device, $_mobile, $_os)
	{
		if(empty(self::$current_device))
		{
			self::detect_device();
		}

		$detect = self::$current_device;

		// device ('all','desktop', 'mobile', 'other')
		// mobile ('all','browser','pwa', 'application','other')
		// os ('all','windows','linux', 'mac', 'android', 'other')

		switch ($_mobile)
		{
			// windows
			case 'windows':
				break;

			case 'linux':
				break;

			// mac
			case 'mac':
				break;

			// android
			case 'android':
				break;

			// default mode
			case 'all':
			case '':
			case null:
			default:
				// ok
				break;
		}

		switch ($_device)
		{
			case 'desktop':
				if(a($detect, 'mobile'))
				{
					return false;
				}
				break;

			case 'mobile':
				if(!a($detect, 'mobile'))
				{
					return false;
				}

				switch ($_mobile)
				{
					// browser
					case 'browser':
						break;

					case 'pwa':
						break;

					// application
					case 'application':
						break;

					// other
					case 'other':
						break;

					// default mode
					case 'all':
					case '':
					case null:
					default:
						// ok
						break;
				}
				break;

			case 'other':
				// ??
				break;

			case 'all':
			case '':
			case null:
			default:
				// ok
				break;

		}

		return true;
	}

}
?>
