<?php
namespace content_a\factor\opr;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(!\dash\request::get('id'))
		{
			\dash\header::status(404, T_("Id not found"));
		}

		$this->get()->ALL();
		$this->post('opr')->ALL();
	}
}
?>
