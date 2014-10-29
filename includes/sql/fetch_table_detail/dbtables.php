<?php
/**
***********************************************************************************
CAUTIONS :YOU DON'T NEED TO RUN THIS FILE!
* 
*THIS FILE READ DATABASE AND CREATE A PHP FILE FOR CREATING FORM
***********************************************************************************
**/
$connect = mysqli_connect("localhost", "jibres", "Jibres@#$567", "jibres");
$qTables = $connect->query("SHOW TABLES FROM jibres");
function _type($type, $def){
	$def = $def ? "!$def" : null;
	preg_match("/^([^(]*)(\((.*)\))?/", $type, $tp);
		$_type = $tp[1];
		$_length = isset($tp[3]) ? $tp[3] : null;
		switch ($_type) {
			case 'enum':
			$_length = preg_replace("[']", "", $_length);
			return ("'type' => '$_type@$_length{$def}'");
			break;
			default:

			return ("'type' => '$_type@$_length{$def}'");
			break;
		}
	}
	while ($row = $qTables->fetch_object()) {
		$content	= "<?php\n";
		$content	.= "namespace sql;\n";
		$TABLENAME	= $row->Tables_in_jibres;
		$content	.= "class $TABLENAME \n{\n";
		$qCOL		= $connect->query("DESCRIBE $TABLENAME");
		$fn			="\n";

		while ($crow = $qCOL->fetch_object()) {
			


			// ========================================================================================== Edit by Javad
			// for fields from currect table except foreign key
			// we remove the table prefix, then show ramained text for name and for label we replace _ with space
			// for foreign key we remove second part of text after _ and show only the name of table without last char
			
			$myfield		= $crow->Field;
			$tmp_pos 		= strpos($myfield, '_');
			$prefix			= substr($myfield, 0, $tmp_pos );
			$myname			= substr($myfield, ($tmp_pos ? $tmp_pos+1 : 0) );
			$myname 		= strtolower($myname);
			// var_dump($myname.' :'.$tmp_pos);
			$mylabel 		= str_replace("_", " ", $myname);
			$mylabel		= ucwords($mylabel);
			$txtcomment		= "\n\t//------------------------------------------------------------------ ";
			$txtstart		= "\tpublic function $crow->Field() \n\t{\n\t\t";
			$txtend			="\n\t}\n";
			// $content		.= "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'label' => '$myname');\n";

			// --------------------------------------------------------------------------------- ID
			if($crow->Field=="id")
			{
				$fn .= $txtcomment. "id - primary key\n";
				$fn .= "\tpublic function $crow->Field() {" . '$this->validate("id");' ."}\n";
				$mylabel = "ID";

			}
			// --------------------------------------------------------------------------------- Foreign Key
			elseif (substr($crow->Field,-2)=="id")
			{
				// for foreign key we use prefix that means we use (table name-last char)
				$fn .= $txtcomment. "id - foreign key\n";
				$fn .= $txtstart. '$this->form("#foreignkey")->name("'. $prefix.'")->validate("id");' .$txtend;
				// $fn .= $txtstart. '$this->form("select")->name("'. $myname.'")->validate("id");';
				// $fn .= "\n\t\t".'$this->setChild($this->form);'.$txtend;

				// $mylabel = str_replace("_", " ", $myfield);
				$mylabel = ucwords(strtolower($prefix));
				$mylabel = $mylabel;
				
			}

			// --------------------------------------------------------------------------------- General
			elseif (substr($crow->Field,-5)=="title")
			{
				$fn .= $txtcomment. "title\n";
				$fn .= $txtstart. '$this->form("#title");'.$txtend;
			}
			elseif (substr($crow->Field,-4)=="slug")
			{
				$fn .= $txtcomment. "slug\n";
				$fn .= $txtstart. '$this->form("#slug");';
				// $fn .= $txtstart. '$this->form("#slug")->name("'. $myname.'")->validate()';
				// $fn .= "\n\t\t->createslug(function()\t{" .'$this->value =\validator_lib::$save'."['form']['".$prefix."_title']->value;});";
				$fn .= $txtend;

				// $this->validate()->xsslug(function()
				// {
				// 	$this->value = \validator_lib::$save['form']['user_email']->value;
				// });
			}
			elseif (substr($crow->Field,-4)=="desc")
			{
				$fn .= $txtcomment. "description\n";
				$fn .= $txtstart. '$this->form("#desc");'.$txtend;

				$mylabel = "Description";
			}

			// --------------------------------------------------------------------------------- User Pass
			elseif (substr($crow->Field,-5)=="email")
			{
				$fn .= $txtcomment. "email\n";
				$fn .= $txtstart. '$this->form("#email");'.$txtend;
			}
			elseif (substr($crow->Field,-4)=="pass")
			{
				$fn .= $txtcomment. "password\n";
				$fn .= $txtstart. '$this->form("#password");'.$txtend;
				$mylabel = "Password";
			}

			// --------------------------------------------------------------------------------- unuse
			elseif($crow->Field=="date_created" or $crow->Field=="date_modified")
			{
				$fn .= "\tpublic function $crow->Field() {}\n";
				$mylabel = str_replace("_", " ", $myfield);
				$mylabel = ucwords(strtolower($mylabel));
				$mylabel = $mylabel;
			}

			// --------------------------------------------------------------------------------- radio
			elseif (substr($crow->Field,-6)=="active" 		|| substr($crow->Field,-4)=="view" 
				|| substr($crow->Field,-3)=="add" 			|| substr($crow->Field,-4)=="edit" 		|| substr($crow->Field,-6)=="delete"
				|| substr($crow->Field,-7)=="service"		|| substr($crow->Field,-6)=="gender"	|| substr($crow->Field,-7)=="married"
				|| substr($crow->Field,-10)=="newsletter"	|| substr($crow->Field,-6)=="credit"	|| substr($crow->Field,-8)=="verified"
				
				
				)	
			{
				$fn .= $txtcomment. "radio button\n";
				$fn .= $txtstart. '$this->form("radio")->name("'. $myname.'");';
				$fn .= "\n\t\t".'$this->setChild($this->form);'.$txtend;
			}

			// --------------------------------------------------------------------------------- select
			elseif (substr($crow->Field,-6)=="status" 	|| substr($crow->Field,-5)=="model" || substr($crow->Field,-8)=="priority"
				|| substr($crow->Field,-3)=="sellin"	|| substr($crow->Field,-3)=="priority"
				|| substr($crow->Field,-4)=="type"

				)
			{
				$fn .= $txtcomment. "select button\n";
				$fn .= $txtstart. '$this->form("select")->name("'. $myname.'")->validate();';
				$fn .= "\n\t\t".'$this->setChild($this->form);'.$txtend;
			}

			// --------------------------------------------------------------------------------- Website
			elseif (substr($crow->Field,-7)=="website")
			{
				$fn .= $txtcomment. "website\n";
				$fn .= $txtstart. '$this->form("#website");'.$txtend;

				// $mylabel = "Description";
			}

			// --------------------------------------------------------------------------------- Other
			else
			{
				// $fn .= $txtcomment. "email\n";
				// $fn .= $txtstart. '$this->form()->name("'. $myname.'")'."\n\t\t".'->validate();'.$txtend;
				$fn .= $txtstart. '$this->form()->name("'. $myname.'");'.$txtend;
				// $fn .= $txtstart. $txtend;
			}
			

			// ========================================================================================== Edit by Javad

		$content .= "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'label' => '$mylabel');\n";

		}
		$content .= $fn;
		$content .= "}\n";
		$content .= "?>";
		// file_put_contents("./created/$TABLENAME.sql.php", $content);
		file_put_contents("../$TABLENAME.sql.php", $content);
	}
	$connect->close();

	echo "Finish..!";
	?>