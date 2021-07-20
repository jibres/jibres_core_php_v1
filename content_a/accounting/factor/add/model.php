<?php
namespace content_a\accounting\factor\add;


class model
{
	public static function getPost()
	{
		$post =
		[
			'template'      => \dash\request::get('type'),

			'year_id'       => \dash\request::post('year_id'),

			'pay_from'      => \dash\request::post('pay_from') ? \dash\request::post('pay_from') : null,
			'put_on'        => \dash\request::post('put_on') ? \dash\request::post('put_on') : null,
			'bank'          => \dash\request::post('bank') ? \dash\request::post('bank') : null,
			'partner'          => \dash\request::post('partner') ? \dash\request::post('partner') : null,
			'petty_cash'    => \dash\request::post('petty_cash') ? \dash\request::post('petty_cash') : null,

			'thirdparty'    => \dash\request::post('thirdparty') ? \dash\request::post('thirdparty') : null,

			'desc'          => \dash\request::post('title'),
			'date'          => \dash\request::post('factordate'),
			'serialnumber'  => \dash\request::post('serialnumber'),

			'total'         => \dash\request::post('total'),
			'totaldiscount' => \dash\request::post('totaldiscount'),
			'totalvat'      => \dash\request::post('totalvat'),
		];

		return $post;
	}


	public static function post()
	{

		if(\dash\request::post('newlockstatus'))
		{
			$post =
			[
				'status' => \dash\request::post('newlockstatus'),
			];

			$result = \lib\app\tax\doc\edit::edit_status($post, \dash\request::get('id'));
			\dash\redirect::pwd();

		}

		$post = self::getPost();

		$post['number']        = \lib\app\tax\doc\get::new_doc_number();

		$add = \lib\app\tax\doc\template::add($post);

		if(\dash\engine\process::status())
		{
			if(isset($add['id']))
			{
				if(\dash\request::post('uploaddoc') === 'uploaddoc' && \dash\request::files('gallery'))
				{
					\content_a\accounting\doc\edit\model::upload_gallery($add['id'], true);
				}

				$result = \lib\app\tax\doc\edit::edit_status(['status' => 'lock'], $add['id']);

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