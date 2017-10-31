<?php
namespace content_a\staff\edit;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{
		$url = \lib\router::get_url();

		// EDIT
		$this->get(false, 'staff_edit')->ALL("/^staff\/edit\=([a-zA-Z0-9]+)(|\/avatar|\/contact|\/identification|\/address)$/");
		$this->post('staff_edit')->ALL("/^staff\/edit\=([a-zA-Z0-9]+)$/");


		if(preg_match("/^staff\/edit\=([a-zA-Z0-9]+)\/contact$/", $url))
		{
			$this->display_name = 'content_a\staff\edit\display\contact.html';
			$this->post('staff_contact')->ALL("/^staff\/edit\=([a-zA-Z0-9]+)\/contact$/");
		}

		if(preg_match("/^staff\/edit\=([a-zA-Z0-9]+)\/identification$/", $url))
		{
			$this->display_name = 'content_a\staff\edit\display\identification.html';
			$this->post('staff_identification')->ALL("/^staff\/edit\=([a-zA-Z0-9]+)\/identification$/");
		}

		if(preg_match("/^staff\/edit\=([a-zA-Z0-9]+)\/address$/", $url))
		{
			$this->display_name = 'content_a\staff\edit\display\address.html';
			$this->post('staff_address')->ALL("/^staff\/edit\=([a-zA-Z0-9]+)\/address$/");
		}

		if(preg_match("/^staff\/edit\=([a-zA-Z0-9]+)\/avatar$/", $url))
		{
			$this->display_name = 'content_a\staff\edit\display\avatar.html';
			$this->post('staff_avatar')->ALL("/^staff\/edit\=([a-zA-Z0-9]+)\/avatar$/");
		}

	}
}
?>