<?php

class StatusResult 
{
	private $messageid;
    private $status;
    private $text;

	public function set_statustext($_text)
	{
		$this->text = $_text;
	}
    public function get_statustext()
    {
    	return $this->text;
    }

    public function set_status($_status)
    {
    	$this->status = $_status;
    }
    public function get_status()
    {
    	return $this->status;
    }

	public function set_messageid($_id)
	{
		$this->messageid=$_id;
	}
    public function get_messageid()
    {
    	return $this->messageid;
    }
}
?>