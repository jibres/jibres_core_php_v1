<?php
namespace content_a\product\edit;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{
		$module_list = ['avatar', 'general', 'idenfity'];

		$url = \lib\router::get_url();

		$child = \lib\router::get_url(2);

		if(!$child)
		{
			\lib\error::page(T_("Invalid url"));
		}

		// need to complete dashboard of product and remove this line to load the dashboar detail
		$this->redirector($this->url('baseFull'). '/product/general/'. $child)->redirect();
		return;

		// $this->get(false, 'edit')->ALL("/^product\/edit\/([a-zA-Z0-9]+)$/");
		// $this->post('edit')->ALL("/^product\/edit\/([a-zA-Z0-9]+)$/");
	}
}
?>