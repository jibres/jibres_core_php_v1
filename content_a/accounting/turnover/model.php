<?php
namespace content_a\accounting\turnover;

class model
{
	public static function post()
	{
		if(\dash\request::post('resetnumber') === 'resetnumber')
		{
			$post           = [];
			$post['year_id'] = \dash\request::post('year_id');

			\lib\app\tax\doc\edit::reset_number($post);

			\dash\redirect::pwd();
		}
	}
}
?>