<?php
namespace content_site\options\count;


class count_post_50
{
	use count;

	public static function this_range()
	{
		return [1,2,3,4,5,6,7,8,9,10,12,15,20,30,40,50];
	}

	public static function default()
	{
		return 3;
	}


	public static function title()
	{
		return T_("Number of posts to show");
	}

}
?>