<?php
namespace content_site\options\count;


class count_post
{
	use count;

	public static function this_range()
	{
		return [1,2,3,4,5,6,7,8,9,10,15,20,25,30,35,40,45,50];
	}

	public static function default()
	{
		return 3;
	}

	public static function option_name()
	{
		return 'count_post';
	}

}
?>