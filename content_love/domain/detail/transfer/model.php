<?php
namespace content_love\domain\detail\transfer;


class model
{
	public static function post()
	{

		if(\dash\request::post('myaction') == 'lock')
		{
			$result = \lib\app\nic_domain\lock::lock(\dash\data::myDomain());

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}
		elseif(\dash\request::post('myaction') == 'unlock')
		{
			$result = \lib\app\nic_domain\lock::unlock(\dash\data::myDomain());

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

	}
}
?>