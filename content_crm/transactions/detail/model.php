<?php
namespace content_crm\transactions\detail;

class model
{
	public static function post()
	{

		if(\dash\request::post('check') === 'again')
		{
			$result = \dash\app\transaction\edit::verify_again(\dash\request::get('id'));
			if($result)
			{
				\dash\redirect::pwd();
			}
		}


	}
}
?>