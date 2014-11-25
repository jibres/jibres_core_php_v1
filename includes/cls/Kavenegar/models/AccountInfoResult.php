<?php

class AccountInfoResult 
{
	private  $credit;
    private $expiredate;
    private $type;

    public function set_type($_type)
    {
    	$this->type = $_type;
    }
    public function get_type()
    {
    	return $this->type;
    }

    public function set_credit($_credit)
    {
    	$this->credit = $_credit;
    }
    public function get_credit()
    {
    	return $this->credit;
    }

    public function set_expiredate($_expiredate)
    {
		$this->expiredate = $_expiredate;
    }
    public function get_expiredate()
    {
    	return $this->expiredate;
    }
}
?>