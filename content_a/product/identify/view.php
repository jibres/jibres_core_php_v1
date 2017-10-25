<?php
namespace content_a\product\identify;

class view extends \content_a\product\view
{

	/**
	 * identify product
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function view_identify($_args)
	{

		$this->data->page['title'] = T_('Personnel Card');
		$this->data->page['desc']  = T_('You can set special verify code for product, like rfid card, barcode or qrcode and we allow you to use this codes on board.');

	}

}
?>