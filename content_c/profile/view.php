<?php
namespace content_c\profile;

class view extends \content_c\main\view
{
	public function view_profile()
	{
		if($this->login('unit_id'))
		{
			$this->data->user_unit = \lib\utility\units::get($this->login('unit_id'), true);
		}
	}
}
?>