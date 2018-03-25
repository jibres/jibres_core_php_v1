<?php
namespace mvc;

class controller
{
	public function project()
	{
		if(\lib\url::directory() === 'main')
		{
			\lib\redirect::to(\lib\url::here());
			\lib\header::status(404);
		}
	}
}
?>
