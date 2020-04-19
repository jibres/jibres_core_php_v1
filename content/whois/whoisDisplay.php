<?php
if(\dash\data::whoisResult())
{
?>


<div class="f justify-center mT20">

	<div class="c12 s12 mT10">

		<?php if(\dash\data::whoisResult_available()) {?>
			<div class="f msg success">
				<div class="c"><?php echo T_("Domain is available"); ?></div>
				<div class="cauto"><a class="btn success2" href="<?php echo \dash\url::kingdom() ?>/domains/search?q=<?php echo \dash\data::myDomain(); ?>"><?php echo T_("Register domain"); ?></a></div>
			</div>


		<?php } //endif ?>


<?php
$whois = \dash\data::whoisResult_pretty();
// if(isset($whois['Domain name']) && is_array($whois['Domain name'])) { make_whois_detail_box("Domain name", $whois['Domain name']);}
if(isset($whois['Registrar']) && is_array($whois['Registrar'])) { make_whois_detail_box("Registrar", $whois['Registrar']);}
if(isset($whois['Important Dates']) && is_array($whois['Important Dates'])) { make_whois_detail_box("Important Dates", $whois['Important Dates']);}
if(isset($whois['Name Servers']) && is_array($whois['Name Servers'])) { make_whois_detail_box("Name Servers", $whois['Name Servers']);}
if(isset($whois['Registrar Info']) && is_array($whois['Registrar Info'])) { make_whois_detail_box("Registrar Info", $whois['Registrar Info']);}

?>

<?php if(\dash\data::whoisResult_answer()) {?>
<div class="box">
	<header><h2 class="f" data-kerkere="#rawresult" data-kerkere-icon="open"><?php echo T_("Whois answer"); ?></h2></header>
	<div class="body zeroPad" id="rawresult">
		<samp><?php echo \dash\data::whoisResult_answer(); ?></samp>
	</div>

</div>
<?php } //endif ?>

	</div>
</div>

<?php } // endif whois result ?>




<?php
function make_whois_detail_box($_title, $_array)
{
	echo '<div class="box">';
		echo '<header>';
		echo '<h2 class="f" data-kerkere="#'. md5($_title). '" data-kerkere-icon="open">';
		echo T_($_title);
		echo '</h2>';
		echo '</header>';
		echo '<div class="body zeroPad" id="'. md5($_title).'">';
			echo '<table class="tbl1 v4">';
			echo '<tbody>';
			foreach ($_array as $key => $value)
			{
				echo '<tr>';
				echo '<td class="txtB">';
					echo $value['title'];
				echo '</td>';

				echo '<td class="ltr">';
					echo $value['value'];
				echo '</td>';
				echo '</tr>';
			}

			echo '</tbody>';
			echo '</table>';
		echo '</div>';
	echo '</div>';
}
?>