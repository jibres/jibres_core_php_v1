


<?php require_once(root. 'content_crm/member/pageSteps.php'); ?>

<div class="f">
 <div class="cauto s12 pA5">
	<?php require_once(root. 'content_crm/member/psidebar.php'); ?>

 </div>
 <div class="c s12 pA5">
	<form class="cbox" method="post" autocomplete="off">

		<h2><?php echo T_("Education detail"); ?></h2>
		<div class="f mT10">
			<div class="c pRa5">


				<label for="education"><?php echo T_("Education"); ?></label>
				<div class="input">
				  <input type="education" name="education" id="education" placeholder='<?php echo T_("Education"); ?>' value="<?php $detail = \dash\data::dataRowMember_detail(); echo \dash\get::index($detail, 'education'); ?>" maxlength='50'>
				</div>


			</div>

			<div class="c pRa5">

				<label for="educationcourse"><?php echo T_("Education Course"); ?></label>
				<div class="input">
				  <input type="educationcourse" name="educationcourse" id="educationcourse" placeholder='<?php echo T_("Education Course"); ?>' value="<?php $detail = \dash\data::dataRowMember_detail(); echo \dash\get::index($detail, 'educationcourse'); ?>" maxlength='50'>
				</div>

			</div>
		</div>



	 <button class="mT25 btn primary block"><?php echo T_("Save"); ?></button>
	</form>
 </div>
</div>






