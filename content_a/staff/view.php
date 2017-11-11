<?php
namespace content_a\staff;


class view extends \content_a\main\view
{

	public function config()
	{
		$meta         = [];
		$meta['type'] = 'staff';

		$this->data->staff_list = \lib\app\staff::list(\lib\utility::get('search'), $meta);
	}
}
?>