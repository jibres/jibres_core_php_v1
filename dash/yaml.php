<?php
namespace dash;


class yaml
{

	public static function save($_file, $_data)
	{
		return yaml_emit_file($_file, $_data);
	}


	public static function read($_file)
	{
		if(!file_exists($_file))
		{
			return null;
		}

		return yaml_parse_file($_file);
	}

}
?>