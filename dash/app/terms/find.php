<?php
namespace dash\app\terms;


class find
{
	public static function tag(string $_string, array $_current_tag = [])
	{

		$check = preg_match_all('/(\s|\>)#([[:^print:]\w]+)/u', $_string, $split);

		if(isset($split[2]) && is_array($split[2]))
		{
			foreach ($split[2] as $key => $value)
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



	public static function tags_link(string $_string, array $_tags)
	{
		$new_string = null;

		foreach ($_tags as $key => $value)
		{
			if(isset($value['title']) && isset($value['link']))
			{
				$link_string = '<a href="'. $value['link']. '" data-hashtag-dir > #'. $value['title'].'</a> ';
				$_string = str_replace('#'. $value['title'], $link_string, $_string);
			}
		}

		return $_string;

	}
}
?>