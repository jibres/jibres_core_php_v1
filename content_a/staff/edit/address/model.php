<?php
namespace content_a\staff\edit\address;


class model extends \content_a\main\model
{

	public static function getPost()
	{
		$post             = [];
		$post['country']  = \lib\utility::post('country');
		$post['province'] = \lib\utility::post('province');
		$post['city']     = \lib\utility::post('city');
		$post['zipcode']  = \lib\utility::post('zipcode');
		$post['address']  = \lib\utility::post('address');
		$post['id']       = \lib\utility::get('id');

		return $post;
	}


	public function post_address($_args)
	{
		\lib\app\staff::edit(self::getPost());

		if(\lib\debug::$status)
		{
			$this->redirector($this->url('full'));
		}
	}
}
?>
