<?php

class ReciveResult 
{
	private $messageid;
    private $sender;
    private $receptor;
    private $message;
    private $date;

    public function set_messageid($id)
    {
    	$this->messageid = $id;
    }
    public function get_messageid()
    {
    	return $this->messageid;
    }

    public function set_sender($_sender)
    {
    	$this->sender = $_sender;
    }
    public function get_sender()
    {
    	return $this->sender;
    }

    public function set_receptor($_receptor)
    {
    	$this->receptor = $_receptor;
    }
    public function get_receptor()
    {
    	return $this->receptor;
    }

    public function set_message($_message)
    {
    	$this->message = $_message;
    }
    public function get_message()
    {
    	return $this->message;
    }

	public function set_date($_date)
	{
		$this->date = $_date;
	}
    public function get_date()
    {
    	return $this->date;
    }
}
?>