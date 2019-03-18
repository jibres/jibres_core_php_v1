<?php
namespace content_i\bank\edit;


class model
{
	public static function post()
	{

		$post                  = [];
		$post['country']       = \dash\request::post('country');
		$post['bank']          = \dash\request::post('pos');
		$post['title']         = \dash\request::post('title');
		$post['accountnumber'] = \dash\request::post('accountnumber');
		$post['shaba']         = \dash\request::post('shaba');
		$post['card']          = \dash\request::post('card');
		$post['iban']          = \dash\request::post('iban');
		$post['swift']         = \dash\request::post('swift');
		$post['branch']        = \dash\request::post('branch');
		$post['branchcode']    = \dash\request::post('branchcode');
		$post['owner']         = \dash\request::post('owner');
		$post['nameoncard']    = \dash\request::post('nameoncard');
		$post['expire']        = \dash\request::post('expire');
		$post['cvv2']          = \dash\request::post('cvv2');
		$post['desc']          = \dash\request::post('desc');

		\lib\app\bank::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}

	}
}
?>