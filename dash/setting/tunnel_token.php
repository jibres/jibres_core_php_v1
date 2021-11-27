<?php
namespace dash\setting;


class tunnel_token
{
	public static function get($_service)
	{
		$file = __DIR__. '/secret/tunnel-tokens/'. $_service. '.conf';

		if(file_exists($file))
		{
			// read file
			return trim(\dash\file::read($file));
		}

		return false;
	}
}
?>