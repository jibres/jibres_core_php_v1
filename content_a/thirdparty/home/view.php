<?php
namespace content_a\thirdparty\home;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('List of thirdpartys');
		$this->data->page['desc']  = T_('You can search in list of thirdpartys, add new member and edit existing.');

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/thirdparty/add';
		$this->data->page['badge']['text'] = T_('Add new thirdparty');

		$meta         = [];

		$this->data->thirdparty_list = \lib\app\staff::list(\lib\utility::get('search'), $meta);

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}
	}
}
?>
