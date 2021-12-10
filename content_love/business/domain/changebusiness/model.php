<?php
namespace content_love\business\domain\changebusiness;


class model
{
	public static function post()
	{
		if(\dash\request::post('changebusiness') === 'changebusiness')
		{

			$result = \lib\app\business_domain\business::changebusiness(\dash\request::get('id'), \dash\data::dataRow_store_id(), \dash\request::get('nbi'));
			if($result)
			{
				\dash\redirect::to(\dash\url::current(). '?id='. \dash\request::get('id'));
			}

		}

	}
}
?>