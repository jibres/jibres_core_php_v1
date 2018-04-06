<?php
namespace content_a\factor\fishprint;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(!\dash\request::get('id'))
		{
			\lib\header::status(404, T_("Id not found"));
		}

		$this->get()->ALL();
	}
}
?>
