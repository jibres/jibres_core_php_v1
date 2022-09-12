<?php
namespace content_love\plan\detail;


class model
{
	public static function post()
	{

		if(\dash\data::dataRow_status() !== 'active')
		{
			\dash\header::status(403, T_("Only active plan record can be edit!"));
		}



		$args =
			[
				'status' => \dash\request::post('status'),
				'reason' => \dash\request::post('reason'),
			];

		\lib\app\plan\planEdit::edit($args, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/datalist?business_id='. \dash\data::storeDetail_id());
		}





	}
}