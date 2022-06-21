<?php
namespace content_a\form\status;

class model
{
	public static function post()
	{
		$form_id = \dash\request::get('id');

		$post =
		[
			'status'    => \dash\request::post('status'),
			'startdate' => \dash\request::post('startdate'),
			'enddate'   => \dash\request::post('enddate'),
			'stime'     => \dash\request::post('starttime'),
			'etime'     => \dash\request::post('endtime'),
			'schedule'  => \dash\request::post('schedule'),
		];

		$result = \lib\app\form\form\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			if(\dash\request::post('status') === 'deleted')
			{
				\dash\redirect::to(\dash\url::this());
			}
			else
			{
				\dash\redirect::pwd();
			}
		}

	}
}
?>