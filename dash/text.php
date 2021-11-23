<?php
namespace dash;

class text
{
	public static function substr_space($_string, $_len)
	{
		if(!$_string || !is_string($_string))
		{
			return $_string;
		}

		$raw = substr($_string, 0, $_len);

		$last_space_position = strrpos($raw, ' ');

		if($last_space_position === false)
		{
			return $raw;
		}

		$text = substr($_string, 0, $last_space_position);

		return $text;

	}
}
?>