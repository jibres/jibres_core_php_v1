<?php
namespace content_a\thirdparty\address;


class model
{

	public static function post()
	{
		if(\dash\request::post('type') === 'remove' && \dash\request::post('addressid'))
		{
			\dash\permission::access('thirdpartyAddressDelete');

			\dash\app\address::remove(\dash\request::post('addressid'));
			\dash\redirect::to(\dash\url::this(). '/address?id='. \dash\request::get('id'));
			return;
		}

		$post                = [];
		$post['title']       = \dash\request::post('title');
		$post['firstname']   = \dash\request::post('firstname');
		$post['lastname']    = \dash\request::post('lastname');
		$post['country']     = \dash\request::post('country');
		$post['city']        = \dash\request::post('city');
		$post['postcode']    = \dash\request::post('postcode');
		$post['phone']       = \dash\request::post('phone');
		$post['province']    = null;
		$post['fax']         = \dash\request::post('fax');
		$post['address']     = \dash\request::post('address');
		$post['address2']    = \dash\request::post('address2');
		$post['company']     = \dash\request::post('company');
		$post['companyname'] = \dash\request::post('companyname');
		$post['jobtitle']    = \dash\request::post('jobtitle');

		if(\dash\request::get('addressid'))
		{
			\dash\permission::access('thirdpartyAddressEdit');
			$result = \dash\app\address::edit($post, \dash\request::get('addressid'));
			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Address successfully edited"));
				\dash\redirect::pwd();
			}
		}
		else
		{
			\dash\permission::access('thirdpartyAddressAdd');
			$result = \dash\app\address::add($post);
			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Address successfully added"));
				\dash\redirect::pwd();
			}
		}

	}
}
?>
