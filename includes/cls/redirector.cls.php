<?php
class redirector_cls{
	private $exit		= true;
	private $url		= false;
	private $subdomain	= false;
	private $method		= null;
	private $aurl;
	private $surl;

	function __construct($redirect = false, $php = false){
		$this->php	= $php;
		$this->surl	= config_lib::$surl;
		$this->aurl	= config_hendel_lib::$real_url;
		if(is_string($redirect)){
			$this->url = preg_replace("/^\//", '', $redirect);
		}
	}

	public function urlChange($str = false, $replace = ''){
		if($str === false){
			$url		= true;
			$this->aurl	= array();
			$this->surl	= array();
		}elseif(is_int($str)){
			$url = (isset($this->aurl[$str]))? $str : count($this->aurl);
		}elseif(is_string($str)){
			$url = (isset($this->surl[$str]))? $str : false;
			if($url){
				$url = array_search($url.'='.$this->surl[$str], $this->aurl);
			}else{
				$url = count($this->aurl);
			}
		}
		if(!is_bool($url)){
			if($replace === false){
				unset($this->aurl[$url]);
			}else{
				if(is_int($str)){
					$this->aurl[$url] = $replace;
				}elseif(is_string($str)){
					$this->surl[$str] = $replace;
					$this->aurl[$url] = $str.'='.$replace;
				}
			}
		}
		return $this;
	}

	public function subdomain($domain){
		$this->subdomain = $domain;
		return $this;
	}

	public function root(){
		$this->subdomain("");
		$this->urlChange();
	}

	public function compileUrl(){
		if($this->url === false){
			$redirect = join($this->aurl, '/');
		}else{
			$redirect = $this->url;
		}
		return $redirect;
	}
	public function redirect(){
		$redirect_url = $this->compileUrl();
		$redirect = 'http://';
		if($this->subdomain !== false){
			$domain = config_hendel_lib::$a_domain;
			if(!empty($this->subdomain)){
				$redirect .= $this->subdomain.'.'.$domain[count($domain)-2].'.'.$domain[count($domain)-1];
			}else{
				$redirect .= $domain[count($domain)-2].'.'.$domain[count($domain)-1];
			}
		}else{
			$redirect .= DOMAIN;
		}
		$redirect .= '/'.$redirect_url;
		if($this->php){
			header('Pragma: no-cache');
			header("HTTP/1.1 301 Moved Permanently"); 
			header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
			header('Location: '.$redirect);
		}else{
			echo '<html><head>';
			echo '<meta http-equiv="refresh" content="2; URL='.$redirect.'">';
			echo "<meta charset='utf-8'>";
			echo'<style type="text/css">body {background-color: #ffffff;background-attachment: fixed;background-repeat: repeat;font-size:12px;font-family:lato;line-height:14px;text-transform:none;color: #ebebeb;}#main{position:fixed;height:494px;width:650px;top:50%;margin-top:-100px;left:50%;margin-left:-325px;font-family:lato;text-align:center;text-transform:uppercase;color:#ebebeb;font-size:50px;line-height:59px; }a {text-decoration:none;color:#a3a3a3;-webkit-transition: all 0.4s linear;-moz-transition: all 0.4s linear;transition: all 0.4s linear;}a:link, a:active, a:visited{color: #a3a3a3;padding-bottom:5px;border-bottom:2px solid #a3a3a3;}a:hover{color: #a3a3a3;}.smaller{font-size:20px;text-transform:lowercase;}</style>';
			echo '</head></body>';
			echo ' <div id="main">';
			echo '  <a href="'.$redirect.'">REDIRECTING YOU</a>';
			echo '  <span class="smaller">'.$redirect.'</span><br>';
			echo ' </div>';
			echo '</body></html>';
		}
		if($this->exit){
			exit();
		}
	}
}
?>