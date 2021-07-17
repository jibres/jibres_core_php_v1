<?php
namespace content_a\accounting\irvat\edit;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');


		if(\dash\request::post('newlockstatus'))
		{
			$post =
			[
				'status' => \dash\request::post('newlockstatus'),
			];

			$result = \lib\app\tax\doc\edit::edit_status($post, \dash\request::get('id'));
			\dash\redirect::pwd();

		}


		if(\dash\request::post('uploaddoc') === 'uploaddoc' && \dash\request::files('gallery'))
		{
			\content_a\accounting\doc\edit\model::upload_gallery($id);
			return;
		}

		if(\dash\request::post('fileaction') === 'remove')
		{
			\content_a\accounting\doc\edit\model::remove_gallery($id);
			return false;
		}

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
		];

		$edit = \lib\app\tax\doc\template::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}

}
?>