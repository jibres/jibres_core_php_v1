<?php
namespace content_a\thirdparty;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('List of third Parties');
		$this->data->page['desc']  = T_('You can search in all type of third parties like staffs, customers and suppliers.');

		$meta         = [];
		$meta['type'] = ["IN", "('staff', 'customer', 'supplier') "];

		$this->data->staff_list = \lib\app\staff::list(\lib\utility::get('search'), $meta);

		if(isset($this->controller->pagnation))
		{
			$this->data->pagnation = $this->controller->pagnation_get();
		}

		$this->data->dashboard_detail = \lib\app\store::dashboard_detail(\lib\store::id());

	}
}
?>
