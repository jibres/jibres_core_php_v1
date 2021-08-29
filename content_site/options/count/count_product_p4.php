<?php
namespace content_site\options\count;


class count_product_p4
{
	use count_product;

	public static function this_range()
	{
		return [10,15,20,30,40];
	}

	public static function default()
	{
		return 10;
	}


}
?>