<?php
namespace content_my\domain\setting\transfer;


class model
{
	public static function post()
	{

		if(\dash\request::post('myaction') == 'lock')
		{
			$result = \lib\app\domains\lock::lock(\dash\data::myDomain());

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}
		elseif(\dash\request::post('myaction') == 'unlock')
		{
			$result = \lib\app\domains\lock::unlock(\dash\data::myDomain());

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

	}
}
?>