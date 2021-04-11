<?php
namespace dash\app\terms;


class find
{
	public static function tag(string $_string, array $_current_tag = [])
	{

		// $check = preg_match_all('/(\s|\>)#([[:^print:]\w]+)/u', $_string, $split);
		$check = preg_match_all('/(\s|\>)#([\p{L}\p{C}\_]+)/u', $_string, $split);

		if(isset($split[2]) && is_array($split[2]))
		{
			foreach ($split[2] as $key => $value)
			{
				if(mb_strlen($value) < 50 && $value)
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

		foreach ($_tags as $tag)
		{
			$link = '$1<a href="'. $tag['link']. '" data-hashtag-dir >#$2</a>$3';
			$_string = preg_replace('/(\s|\>)#('.$tag['title'].')([^\p{L}^\p{C}^\_]+)/u', $link, $_string);
		}

		return $_string;

	}
}
?>