<?php
namespace content_a\thirdparty\general;


class model
{
	public static function post()
	{
		\dash\permission::access('aThirdPartyEdit');
		$request = self::getPost();

		\lib\app\thirdparty::edit($request, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}


	public static function getPost()
	{
		$thirdparty = \lib\app\thirdparty::get(\dash\request::get('id'));

		if(isset($thirdparty['supplier']) || (isset($thirdparty['type']) && $thirdparty['type'] === 'supplier'))
		{
			$post =
			[
				'type'          => 'supplier',
				'visitorname'   => \dash\request::post('visitorname'),
				'visitormobile' => \dash\request::post('visitormobile'),
				'company'       => \dash\request::post('company'),
			];
		}
		else
		{
			$post                 = [];
			$post['mobile']       = \dash\utility\filter::mobile(\dash\request::post('mobile'));
			$post['type']         = \dash\request::get('type');
			$post['firstname']    = \dash\request::post('name');
			$post['lastname']     = \dash\request::post('lastName');
			$post['nationalcode'] = \dash\request::post('nationalcode');
			$post['gender']       = \dash\request::post('gender') === 'on' ? 'female' : 'male';
			$post['birthday']     = \dash\request::post('birthday');
			$post['code']         = \dash\request::post('code');
			// $post['address']      = \dash\request::post('address');
			$post['phone']        = \dash\request::post('phone');
			$post['desc']         = \dash\request::post('desc');
			$post['staff']        = \dash\request::post('staff');

			if(\dash\permission::check("aThirdPartyPermissionChange"))
			{
				$post['permission'] = \dash\request::post('permission');
				$post['permission'] = $post['permission'] === '0' ? null : $post['permission'];
			}

		}

		return $post;
	}
}
?>
