<?php


class ApiHelper
{

	
	public static  function getApiPath($base,$method)
	{
		return sprintf(API_PATH,API_KEY,$base,$method);
	}

}

?>