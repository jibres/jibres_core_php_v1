<?php
namespace content_a\sell\pay;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Pay factor');
		$this->data->page['desc']  = T_('You can search in list of pays, and select one of pay');

		$this->data->page['badge']['link'] = $this->url('baseFull'). '/sell';
		$this->data->page['badge']['text'] = T_('Back to last sales');
	}
}
?>
