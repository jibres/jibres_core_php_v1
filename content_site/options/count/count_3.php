<?php
namespace content_site\options\count;


class count_3
{
	use count;

	public static function this_range()
	{
		return [3,6,9,12,18,30,90];
	}

	public static function default()
	{
		return 3;
	}

	public static function option_name()
	{
		return 'count_3';
	}

}
?>