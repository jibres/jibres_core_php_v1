<?php
namespace content_crm\transactions\detail;

class model
{
	public static function post()
	{

		if(\dash\request::post('check') === 'again')
		{
			$id = \dash\request::get('tid');
			if(!$id)
			{
				$id = \dash\request::get('id');
			}

			$result = \dash\app\transaction\edit::verify_again($id);
			if($result)
			{
				\dash\redirect::pwd();
			}
		}


	}
}
?>