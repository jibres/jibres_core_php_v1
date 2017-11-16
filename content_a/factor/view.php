<?php
namespace content_a\factor;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Factor');
		$this->data->page['desc']  = T_('Register any type of factor');
	}
}
?>
