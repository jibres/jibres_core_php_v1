<?php
namespace content\domains\home;


class controller
{
	public static function routing()
	{
		if((\dash\url::child() === 'renew' || \dash\url::child() === 'transfer') && !\dash\url::subchild() )
		{
			$new_url = \dash\url::kingdom(). '/my/domain/'. \dash\url::child();
			if(\dash\url::query())
			{
				$new_url .= '?'. \dash\url::query();
			}
			\dash\redirect::to($new_url);
		}

		if((\dash\url::child() === 'buy' ) && \dash\url::subchild() && \dash\validate::domain(\dash\url::subchild(), false) )
		{
			$new_url = \dash\url::kingdom(). '/my/domain/'. \dash\url::child(). '/'. \dash\url::subchild();
			\dash\redirect::to($new_url);
		}

		if(\dash\url::child() === 'whois' && !\dash\url::subchild())
		{
			$new_url = \dash\url::kingdom(). '/whois/';
			if(\dash\url::query())
			{
				$new_url .= '?'. \dash\url::query();
			}
			\dash\redirect::to($new_url);
		}
	}
}
?>