<?php
namespace lib\pagebuilder\body\device;


class device
{

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
		return $_data;
	}




}
?>
