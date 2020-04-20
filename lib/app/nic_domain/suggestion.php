<?php
namespace lib\app\nic_domain;


class suggestion
{
	public static function get($_domain)
	{
		$count_chars = count_chars($_domain, 1);

		arsort($count_chars);

		$fchar = null;

		foreach ($count_chars as $key => $value)
		{
			$fchar = chr($key);
			break;
		}

		$first_char = substr($_domain, 0, 1);

		$list_domain_suggestion = \lib\db\domains\get::suggestion_char($first_char, $fchar, 3);

		return $list_domain_suggestion;
	}
}
?>