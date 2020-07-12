<?php
namespace content_a\irvat\edit;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');

		if(self::upload_gallery($id))
		{
			return false;
		}


		if(\dash\request::post('fileaction') === 'remove')
		{
			self::remove_gallery($id);
			return false;
		}


		if(\dash\request::post('save') === 'legal')
		{
			$post =
			[
				'companyname'           => \dash\request::post('companyname'),
				'companyregisternumber' => \dash\request::post('companyregisternumber'),
				'companynationalid'     => \dash\request::post('companynationalid'),
				'companyeconomiccode'   => \dash\request::post('companyeconomiccode'),
				'ceonationalcode'       => \dash\request::post('ceonationalcode'),
				'country'               => \dash\request::post('country'),
				'province'              => \dash\request::post('province'),
				'city'                  => \dash\request::post('city'),
				'address'               => \dash\request::post('address'),
				'postcode'              => \dash\request::post('postcode'),
				'phone'                 => \dash\request::post('phone'),
				'fax'                   => \dash\request::post('fax'),
			];


			\dash\app\user\legal::set($post, \dash\request::post('legal_user'));

		}

		$post =
		[
			'title'             => \dash\request::post('title'),
			'code'              => \dash\request::post('code'),
			'serialnumber'      => \dash\request::post('serialnumber'),
			'factordate'        => \dash\request::post('factordate'),
			'type'              => \dash\data::dataRow_type(),
			'total'             => \dash\request::post('total'),
			'subtotalitembyvat' => \dash\request::post('subtotalitembyvat'),
			'sumvat'            => \dash\request::post('sumvat'),
			'items'             => \dash\request::post('items'),
			'itemsvat'          => \dash\request::post('itemsvat'),
			'official'          => \dash\request::post('official'),
			'vat'               => \dash\request::post('vat'),
			'desc'              => \dash\request::post('desc'),


			'mobile'      => \dash\request::post('memberTl'),
			'gender'      => \dash\request::post('memberGender') ? \dash\request::post('memberGender') : null,
			'displayname' => \dash\request::post('memberN'),

		];

		if(\dash\request::post('customer'))
		{
			$post['customer'] = \dash\request::post('customer');
		}

		if(\dash\request::post('seller'))
		{
			$post['seller'] = \dash\request::post('seller');
		}


		$edit = \lib\app\irvat\edit::edit($post, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}


	public static function remove_gallery($_id)
	{
		$fileid = \dash\request::post('fileid');
		\lib\app\irvat\gallery::gallery($_id, $fileid, 'remove');
		\dash\notif::ok(T_("File removed"));
		// \dash\redirect::pwd();
	}



	public static function upload_gallery($_id)
	{
		if(\dash\request::files('gallery'))
		{
			$uploaded_file = \dash\upload\irvat::set_irvat_gallery($_id);

			if(isset($uploaded_file['id']))
			{
				// save uploaded file
				\lib\app\irvat\gallery::gallery($_id, $uploaded_file, 'add');
			}

			if(!\dash\engine\process::status())
			{
				// \dash\notif::error(T_("Can not upload file"));
			}
			else
			{
				\dash\notif::ok(T_("File successfully uploaded"));
 				\dash\redirect::pwd();
			}

			return true;
		}
		return false;

	}
}
?>