<?php
class model extends main_model
{
	function post_login()
	{
		// for debug you can uncomment below line to disallow redirect
		// $this->redirect		= false;
		$mymobile			= str_replace(' ', '', post::mobile());
		$tmp_result			=  $this->sql()->tableUsers()->whereUser_mobile($mymobile)->select();
		$mypass				= md5(post::password());
		

		debug_lib::true("Login".$tmp_result->num().$mypass );
		if($tmp_result->num() == 1)
		{
			// mobile exist
			
			$tmp_result = $tmp_result->assoc();
			if (isset($tmp_result['user_pass']) && $tmp_result['user_pass'] == $mypass)
			{
				// password is correct
				$_SESSION['login']	= true;
				$_SESSION['user']	= array();
				$tmp_fields			=  array('type', 'gender', 'firstname', 'lastname', 'nickname', 'mobile', 'status', 'credit');
				foreach ($tmp_fields as $key => $value) 
				{
					$_SESSION['user'][$value]	= $tmp_result['user_'.$value];
				}
				$_SESSION['user']['permission_id']	= $tmp_result['permission_id'];
				
				debug_lib::true("Login successfully");
				$this->redirect->urlChange()->subdomain("cp");
			}
			else
			{
				// password is incorrect
				// unset($_SESSION['user']);
				debug_lib::fatal("Password is incorrect");
			}
		}
		elseif($tmp_result->num() == 0 )
		{
			// mobile does not exits
			debug_lib::fatal("Mobile number is incorrect");
		}

		else
		{
			// mobile exist more than 2 times!
			debug_lib::fatal("Please forward this message to Administrator");
		}
	}
}
?>