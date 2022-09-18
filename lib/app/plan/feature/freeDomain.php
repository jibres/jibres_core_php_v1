<?php
namespace lib\app\plan\feature;

class freeDomain extends featurePreapre
{

	private $irDomain = null;
	private $comDomain = null;


	public function __construct($_init)
	{
		if(isset($_init['irDomain']) && $_init['irDomain'])
		{
			$this->irDomain = true;
		}

		if(isset($_init['comDomain']) && $_init['comDomain'])
		{
			$this->comDomain = true;
		}
	}




	public function group() : string
	{
		return T_("Feature");
	}


	public function title() : string
	{
		return T_("Gift domain");
	}


	public function value() 
	{
		if(!$this->irDomain && !$this->comDomain)
		{
			return false;
		}

		$value = '';

		if($this->irDomain)
		{
			$value .= T_(".ir domain");
		}

		if($this->comDomain)
		{
			$value .= '<br>';
			$value .= T_(".com domain");
		}


		return $value;

	}



}