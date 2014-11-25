<?php
class SendResult 
{
	private $messageid;
    private $message;
    private $receptor;
    private $cost;
    private $date;
    private $status;
    private $statustext;

    public function set_messageid($id)
    {
    	$this->messageid = $id;
    }
    public function get_messageid()
    {
    	return $this->messageid;
    }


	public function set_status($_status)
	{
		$this->status = $_status;
	}
    public function get_status()
    {
    	return $this->status;
    }


	public function set_statustext($_text)
	{
		$this->statustext = $_text;
	}
    public function get_statustext()
    {
    	return $this->statustext;
    }

	public function set_cost($_cost)
	{
		$this->cost = $_cost;
	}
    public function get_cost()
    {
    	return $this->cost;
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