<?php
namespace lib\app\plan\feature;

class allowedFileSize extends featurePreapre
{

	private $size = null;


	public function __construct($_init)
	{
		if(isset($_init['size']))
		{
			$this->size = $_init['size'];
		}
	}


	public function group() : string
	{
		return T_("Feature");
	}


	public function title() : string
	{
		return T_("Allowed file upload size");
	}


	public function value() : string
	{
		return \dash\fit::file_size($this->size);

	}

	public function access() : bool
	{
		return false;
	}


}