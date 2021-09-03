<?php
namespace content_a\website\imageblock;

class model
{
	public static function post()
	{
		if(\dash\request::post('sort') === 'sort')
		{
			\lib\app\website\body\line\imageblock::set_sort(\dash\data::imageblockID(), \dash\request::post('imageblock'));
			return true;
		}
	}
}
?>
