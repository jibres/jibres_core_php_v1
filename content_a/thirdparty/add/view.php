<?php
namespace content_a\thirdparty\add;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Add new thirdparty');
		$this->data->page['desc']  = T_('You can add new thirdparty and after add with minimal data, we allow you to add extra detail of thirdparty.');
	}
}
?>
