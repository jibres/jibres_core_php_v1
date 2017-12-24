<?php
namespace content_a\factor;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Factor');
		$this->data->page['desc']  = T_('Register any type of factor');

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/sell/add';
		$this->data->page['badge']['text'] = T_('Add new sell');

		$this->data->factor_dashboard_detail = \lib\app\factor::dashboard();
	}
}
?>
