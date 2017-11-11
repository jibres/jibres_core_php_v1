<?php
namespace content_a\product\edit;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(!\lib\router::get_url(2))
		{
			\lib\error::page(T_("Invalid url"));
		}

		// need to complete dashboard of product and remove this line to load the dashboar detail
		$this->redirector($this->url('baseFull'). '/product/')->redirect();
	}
}
?>
