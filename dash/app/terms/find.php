<?php
namespace dash\app\terms;


class find
{
	public static function tag(string $_string, array $_current_tag = [])
	{
		$check = preg_match_all("/#(\w+)/u", $_string, $split);

		if(isset($split[1]) && is_array($split[1]))
		{
			foreach ($split[1] as $key => $value)
			{
				if(mb_strlen($value) < 50)
				{
					$_current_tag[] = $value;
				}
			}
		}

		$_current_tag = array_filter($_current_tag);
		$_current_tag = array_unique($_current_tag);

		return $_current_tag;

	}
}
?>