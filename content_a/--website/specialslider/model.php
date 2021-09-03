<?php
namespace content_a\website\specialslider;

class model
{
	public static function post()
	{
		if(\dash\request::post('sort') === 'sort')
		{
			\lib\app\website\body\line\specialslider::set_sort(\dash\data::specialsliderID(), \dash\request::post('specialslider'));
			return true;
		}
	}
}
?>
