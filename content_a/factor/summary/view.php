<?php
namespace content_a\factor\summary;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Factors Summary');
		$this->data->page['desc']  = T_('Some detail about your factors and choose specefic type to add new type of factor.');

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/factor/add';
		$this->data->page['badge']['text'] = T_('Quick add new sale factor');

		$this->data->factor_dashboard_detail = \lib\app\factor::dashboard();
	}
}
?>
