<?php
namespace content_a\thirdparty\edit\general;


class model extends \content_a\main\model
{

	public static function getPost()
	{
		$thirdparty             = \lib\app\thirdparty::get(\lib\utility::get('id'));

		if(isset($thirdparty['supplier']) || (isset($thirdparty['type']) && $thirdparty['type'] === 'supplier'))
		{
			$post =
			[
				'type'          => 'supplier',
				'visitorname'   => \lib\request::post('visitorname'),
				'visitormobile' => \lib\request::post('visitormobile'),
				'company'       => \lib\request::post('company'),
			];
		}
		else
		{
			$post                 = [];
			$post['mobile']       = \lib\utility\filter::mobile(\lib\request::post('mobile'));
			$post['type']         = \lib\utility::get('type');
			$post['firstname']    = \lib\request::post('name');
			$post['lastname']     = \lib\request::post('lastName');
			$post['nationalcode'] = \lib\request::post('nationalcode');
			$post['gender']       = \lib\request::post('gender') === 'on' ? 'female' : 'male';
			$post['birthday']     = \lib\request::post('birthday');
			$post['code']         = \lib\request::post('code');
			$post['address']      = \lib\request::post('address');
			$post['phone']        = \lib\request::post('phone');
			$post['desc']         = \lib\request::post('desc');

		}

		return $post;
	}


	public function post_general($_args)
	{
		$request       = self::getPost();

		\lib\app\thirdparty::edit($request, \lib\utility::get('id'));

		if(\lib\debug::$status)
		{
			$this->redirector(\lib\url::pwd());
		}
	}
}
?>
