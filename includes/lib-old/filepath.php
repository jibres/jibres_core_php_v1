<?php
namespace lib;

class filepath
{

	public static function fix($_path)
	{
		if(!$_path || !is_string($_path))
		{
			return $_path;
		}

		$com_address = 'https://jibres.com/files/';
		$ir_address  = 'https://jibres.ir/files/';

		if(substr($_path, 0, 25) === $com_address)
		{
			if(\dash\url::tld() === 'ir')
			{
				$_path = str_replace($com_address, $ir_address, $_path);
			}
		}
		elseif(substr($_path, 0, 24) === $ir_address)
		{
			if(\dash\url::tld() === 'com')
			{
				$_path = str_replace($ir_address, $com_address, $_path);
			}
		}

		return $_path;
	}
}
?>