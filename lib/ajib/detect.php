<?php
namespace lib\ajib;


class detect
{
	public $commad = null;

	public function __construct($_args)
	{
		if(isset($_args[1]))
		{
			$this->commad = $_args[1];
		}


		if(!$this->commad)
		{
			return throw new \Exception("Ajib argument is required", 1);
		}
	}


	public function go()
	{
		switch ($this->commad)
		{
			case 'install-jibres-db':
				$ok = (new \lib\ajib\installdb)->install();
				break;

			default:
				return throw new \Exception("Invalid ajib argument", 1);
				break;
		}

		if($ok)
		{
			return 'Ok. ;)';
		}
	}
}
?>