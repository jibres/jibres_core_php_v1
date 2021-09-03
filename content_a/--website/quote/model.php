<?php
namespace content_a\website\quote;

class model
{
	public static function post()
	{
		if(\dash\request::post('sort') === 'sort')
		{
			\lib\app\website\body\line\quote::set_sort(\dash\data::quoteID(), \dash\request::post('quote'));
			return true;
		}
	}
}
?>
