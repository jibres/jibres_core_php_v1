<?php
namespace content_i\cheque\add;

class model
{
	public static function post()
	{

		$post                  = [];
		$post['amount']        = \dash\request::post('amount');
		$post['babat']         = \dash\request::post('babat');
		$post['bank']          = \dash\request::post('bank');
		$post['bank_id']       = \dash\request::post('bank_id');
		$post['branch']        = \dash\request::post('branch');
		$post['chequebook_id'] = \dash\request::post('chequebook_id');
		$post['date']          = \dash\request::post('date');
		$post['desc']          = \dash\request::post('desc');
		$post['getdate']       = \dash\request::post('getdate');
		$post['number']        = \dash\request::post('number');
		$post['owner']         = \dash\request::post('owner');
		$post['thirdparty']    = \dash\request::post('thirdparty');
		$post['type']          = \dash\request::post('type');
		$post['vajh']          = \dash\request::post('vajh');

		\lib\app\cheque::add($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>