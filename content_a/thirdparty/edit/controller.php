<?php
namespace content_a\thirdparty\edit;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(\dash\request::get('id'))
		{
			\lib\redirect::to(\dash\url::here(). '/thirdparty/edit/general?id='.\dash\request::get('id'));
		}
		else
		{
			\lib\redirect::to(\dash\url::here(). '/thirdparty');
		}

		// \lib\header::status(404, T_("Invalid url"));
	}
}
?>
