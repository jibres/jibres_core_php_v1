<?php
namespace content_a\website\slider;

class model
{
	public static function post()
	{
		if(\dash\request::post('sort') === 'sort')
		{
			\lib\app\website\body\line\slider::set_sort(\dash\data::sliderID(), \dash\request::post('slider'));
			return true;
		}
	}
}
?>
