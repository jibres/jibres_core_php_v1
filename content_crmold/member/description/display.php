
<?php require_once(root. 'content_crm/member/pageSteps.php'); ?>

<div class="f">
 <div class="cauto s12 pA5">
<?php require_once(root. 'content_crm/member/psidebar.php'); ?>
 </div>
 <div class="c s12 pA5">
	<div class="cbox" method="post"  autocomplete="off">
			<section class="sTimeline">

		  <div class="event" >
		    <div class="box">
		      <form method="post" autocomplete="off" >
		        <h2><?php echo T_("Add note"); ?></h2>
		        <input type="hidden" name="redirecturl" value="<?php echo \dash\url::pwd(); ?>">
		        <textarea class="txt " name="note" rows="3" <?php \dash\layout\autofocus::html() ?> placeholder='<?php echo T_("Write your note about user."); ?> <?php echo T_("Something like calls, favorites, hobbits, special approach or something else."); ?>'></textarea>
		        <button class="btn secondary block mT5"><?php echo T_("Add new note"); ?></button>
		      </form>
		    </div>
		  </div>

		  <?php foreach (\dash\data::dataTable() as $key => $value) {?>


		  <div class="event" data-done>
		    <div class="box">

		      <div class="detail f">
		          <div class="cauto"><i class="sf-certificate"></i><?php echo \dash\get::index($value, 'firstname'); ?> <b><?php echo \dash\get::index($value, 'lastname'); ?></b></div>
		          <div class="cauto os"><i class="sf-calendar-o pRa5"></i><?php echo \dash\fit::date($value['datecreated']); ?></div>
		        </div>
		      <p><?php echo \dash\get::index($value, 'text'); ?></p>
		    </div>
		  </div>

		  <?php } ?>

		</section>
	</div>

	<?php \dash\utility\pagination::html(); ?>
 </div>
</div>


