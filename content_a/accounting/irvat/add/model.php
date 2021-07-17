<?php
namespace content_a\accounting\irvat\add;


class model
{
	public static function post()
	{

		$post =
		[
			'template'      => \dash\request::get('type'),

			'year_id'       => \dash\request::post('year_id'),

			'pay_from'      => \dash\request::post('pay_from'),
			'put_on'        => \dash\request::post('put_on'),
			'tax'           => \dash\request::post('tax'),
			'vat'           => \dash\request::post('vat'),
			'thirdparty'    => \dash\request::post('thirdparty'),

			'desc'          => \dash\request::post('title'),
			'date'          => \dash\request::post('factordate'),
			'serialnumber'  => \dash\request::post('serialnumber'),

			'total'         => \dash\request::post('total'),
			'totaldiscount' => \dash\request::post('totaldiscount'),
			'totalvat'      => \dash\request::post('totalvat'),
			'number'        => \lib\app\tax\doc\get::new_doc_number(), // auto doc number
		];

		$add = \lib\app\tax\doc\template::add($post);

		if(\dash\engine\process::status())
		{
			if(isset($add['id']))
			{
				\dash\redirect::to(\dash\url::that(). '/edit?id='. $add['id']);
			}
			else
			{
				\dash\redirect::to(\dash\url::that());
			}
		}

	}
}
?>