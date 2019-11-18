<?php
namespace lib;


class server
{

	public static function db()
	{
		if(\dash\url::root() === 'jibres')
		{
			if(\dash\url::subdomain())
			{
				// search in subdomain
			}
			else
			{
				// master jibres server
			}
		}
		else
		{
			// search in domains
		}
	}
}
?>