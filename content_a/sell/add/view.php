<?php
namespace content_a\sell\add;


class view extends \content_a\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_('Sale invoicing');
		$this->data->page['desc']  = T_('Sell your product via Jibres and enjoy using integrated web base platform.');
	}
}
?>
