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
function _type($type, $def)
{
	$def = $def ? "!$def" : null;
	preg_match("/^([^(]*)(\((.*)\))?/", $type, $tp);
		$_type = $tp[1];
		$_length = isset($tp[3]) ? $tp[3] : null;
		switch ($_type) 
		{
			case 'enum':
			$_length = preg_replace("[']", "", $_length);
			return ("'type' => '$_type@$_length{$def}'");
			break;
			default:

			return ("'type' => '$_type@$_length{$def}'");
			break;
		}
}
	while ($row = $qTables->fetch_object()) 
	{
		$content	= "<?php\n";
		$content	.= "namespace sql;\n";
		$TABLENAME	= $row->Tables_in_jibres;
		$content	.= "class $TABLENAME \n{\n";
		$qCOL		= $connect->query("DESCRIBE $TABLENAME");
		$fn			="\n";

		while ($crow = $qCOL->fetch_object()) 
		{
			// var_dump($crow);

			// ========================================================================================== Edit by Javad
			// for fields from currect table except foreign key
			// we remove the table prefix, then show ramained text for name and for label we replace _ with space
			// for foreign key we remove second part of text after _ and show only the name of table without last char
			
			$myfield		= $crow->Field;
			$mynull			= $crow->Null;
			$tmp_pos 		= strpos($myfield, '_');
			$prefix			= substr($myfield, 0, $tmp_pos );
			$isforeign		= false;
			$myname			= substr($myfield, ($tmp_pos ? $tmp_pos+1 : 0) );
			
			$myname 		= strtolower($myname);
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
			elseif ($myname=="id")
			{
				// for foreign key we use prefix that means we use (table name-last char)
				$fn .= $txtcomment. "id - foreign key\n";
				// $fn .= $txtstart. '$this->form("#foreignkey")->name("'. $prefix.'")->validate("id");' .$txtend;
				$fn .= $txtstart. '$this->form("select")->name("'. $prefix.'")->validate("id");';
				$fn .= "\n\t\t".'$this->setChild($this->form);'.$txtend;

				// $mylabel = str_replace("_", " ", $myfield);
				$isforeign	= true;
				$mylabel	= ucwords(strtolower($prefix));
				$mylabel	= $mylabel;
				
			}

			// --------------------------------------------------------------------------------- General
			elseif ($myname=='title')
			{
				$fn .= $txtcomment. 'title'."\n";
				$fn .= $txtstart. '$this->form("text")->name("title");'.$txtend;
			}
			elseif ($myname=="slug")
			{
				$fn .= $txtcomment. "slug\n";
				// $fn .= $txtstart. '$this->form("#slug");';
				$fn .= $txtstart. '$this->form("text")->name("'. $myname.'")->validate()->slugify("'.$prefix.'_title");';
				
				// $fn .= $txtstart. '$this->form("text")->name("'. $myname.'")->validate()';
				// $fn .= "\n\t\t->createslug(function()\t{" .'$this->value =\validator_lib::$save'."['form']['".$prefix."_title']->value;});";
				$fn .= $txtend;

				// $this->validate()->xsslug(function()
				// {
				// 	$this->value = \validator_lib::$save['form']['user_email']->value;
				// });
			}
			elseif ($myname=="desc")
			{
				$fn .= $txtcomment. "description\n";
				$fn .= $txtstart. '$this->form("#desc");'.$txtend;

				$mylabel = "Description";
			}

			// --------------------------------------------------------------------------------- User Pass
			elseif ($myname=="email")
			{
				$fn .= $txtcomment. "email\n";
				$fn .= $txtstart. '$this->form("#email");'.$txtend;
			}
			elseif ($myname=="pass")
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
			elseif($crow->Field=="attachment_type")
			{
				$fn .= $txtstart. '$this->form("text")->name("'. $myname.'");'.$txtend;
			}

			// --------------------------------------------------------------------------------- radio
			elseif ($myname=="active" 		|| $myname=="view"		|| $myname=="verified"
				|| $myname=="add" 			|| $myname=="edit" 		|| $myname=="delete"
				|| $myname=="service"		|| $myname=="gender"	|| $myname=="married"
				|| $myname=="newsletter"	|| $myname=="credit"	|| $crow->Field=="permission_status"
				
				
				)	
			{
				$fn .= $txtcomment. "radio button\n";
				$fn .= $txtstart. '$this->form("radio")->name("'. $myname.'");';
				$fn .= "\n\t\t".'$this->setChild($this->form);'.$txtend;
			}

			// --------------------------------------------------------------------------------- select
			elseif ($myname=="status" 	|| $myname=="model" || $myname=="priority"
				|| $myname=="sellin"	|| $myname=="priority"
				|| $myname=="type"

				)
			{
				$fn .= $txtcomment. "select button\n";
				$fn .= $txtstart. '$this->form("select")->name("'. $myname.'")->validate();';
				$fn .= "\n\t\t".'$this->setChild($this->form);'.$txtend;
			}

			// --------------------------------------------------------------------------------- Website
			elseif ($myname=="website")
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
				$fn .= $txtstart. '$this->form("text")->name("'. $myname.'");'.$txtend;
				// $fn .= $txtstart. $txtend;
			}
			

			// ========================================================================================== Edit by Javad

			// $content .= "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'label' => '$mylabel');\n";
			// 'foreign' => 'table@id!value'
			$fields	= "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'null' =>'$mynull' ,'label' => '$mylabel');\n";
			if($isforeign)
			{
				$table 	= $prefix.'s';
				$fields = "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'null' =>'$mynull' ,'label' => '$mylabel', 'foreign' => '$table@id!".$prefix."_title');\n";
				if($table=="users")
				{
					$fields = "\tpublic \$$crow->Field = array(". _type($crow->Type, $crow->Default).", 'null' =>'$mynull' ,'label' => '$mylabel', 'foreign' => '$table@id!".$prefix."_nickname');\n";
				}
			}

			$content .= $fields;
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