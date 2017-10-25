<?php
namespace content_c\billing\invoice;

class view extends \content_c\main\view
{
	public function config()
	{
		$this->data->page['title'] = T_("Invoice Detail");
		$this->data->page['desc'] = T_("Check invoice and detail of it");

	}


	/**
	 * { function_description }
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function view_invoice($_args)
	{
		if(!$this->login())
		{
			return;
		}

		$invoice = $_args->api_callback;
		$this->data->invoice = $invoice;

	}

}
?>