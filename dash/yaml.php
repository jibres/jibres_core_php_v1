<?php
namespace dash;


class yaml
{

	public static function save($_file, $_data)
	{
		if(!function_exists('yaml_emit_file'))
		{
			if (!extension_loaded('yaml'))
			{
				return false;
			}
			return null;
		}

		if(!$_file)
		{
			return false;
		}

		return yaml_emit_file($_file, $_data);
	}


	public static function read($_file)
	{
		if(!function_exists('yaml_parse_file'))
		{
			if (!extension_loaded('yaml'))
			{
				return false;
			}
			return null;
		}

		if(!file_exists($_file))
		{
			return null;
		}

		$data = null;
		try
		{
			$data = @yaml_parse_file($_file);

		} catch (Exception $e)
		{
			$data = false;
		}

		return $data;
	}

}
?>