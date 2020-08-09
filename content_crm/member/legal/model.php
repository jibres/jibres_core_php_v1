<?php
namespace content_crm\member\legal;


class model
{

	public static function post()
	{
		if(\dash\request::post('accounting') === 'accounting')
		{
			if(\dash\request::post('removeassistant') === 'removeassistant')
			{
				$post =
				[
					'accounting_details_id' => null
				];

				\dash\app\user\legal::set($post, \dash\request::get('id'));

				\dash\redirect::pwd();
			}
			else
			{
				$assistant_id = \dash\request::post('assistant_id');
				if(!$assistant_id || !is_numeric($assistant_id))
				{
					\dash\notif::error(T_("Please choose the acounting assistant"));
					return false;
				}

				$post =
				[
					'parent' => $assistant_id,
					'title'  => \dash\request::post('accountindetailname'),
					'code'   => \lib\app\tax\coding\get::generate_code_details($assistant_id),
					'type'   => 'details',
				];

				$result = \lib\app\tax\coding\add::add($post);

				if(\dash\engine\process::status() && isset($result['id']))
				{
					$post =
					[
						'accounting_details_id'                 => $result['id'],
					];

					\dash\app\user\legal::set($post, \dash\request::get('id'));

					\dash\redirect::pwd();
				}

			}

		}
		else
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


			\dash\app\user\legal::set($post, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}
	}
}
?>