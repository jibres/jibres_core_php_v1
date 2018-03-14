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
				'visitorname'   => \lib\utility::post('visitorname'),
				'visitormobile' => \lib\utility::post('visitormobile'),
				'company'       => \lib\utility::post('company'),
			];
		}
		else
		{
			$post                 = [];
			$post['mobile']       = \lib\utility\filter::mobile(\lib\utility::post('mobile'));
			$post['type']         = \lib\utility::get('type');
			$post['firstname']    = \lib\utility::post('name');
			$post['lastname']     = \lib\utility::post('lastName');
			$post['nationalcode'] = \lib\utility::post('nationalcode');
			$post['gender']       = \lib\utility::post('gender') === 'on' ? 'female' : 'male';
			$post['birthday']     = \lib\utility::post('birthday');
			$post['code']         = \lib\utility::post('code');
			$post['address']      = \lib\utility::post('address');
			$post['phone']        = \lib\utility::post('phone');
			$post['desc']         = \lib\utility::post('desc');

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
