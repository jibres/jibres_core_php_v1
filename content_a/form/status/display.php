<div class="row">
	<div class="c-xs-12 c-sm-12 c-md-4">
		<?php require_once(root. 'content_a/form/itemLink.php');
		 ?>
	</div>
	<div class="c-xs-12 c-sm-12 c-md-8">



<form method="post" autocomplete="off" id="form1" data-patch>
	<div class="box">
		<div class="pad">

			<div class="row">

          <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
            <div class="radio4">
              <input  id="draft" type="radio" name="status" value="draft" <?php if(\dash\data::dataRow_status() == 'draft') {echo 'checked';} ?>>
              <label for="draft">
                <div>
                  <div class="title"><?php echo T_("Draft"); ?></div>
                  <div class="addr"><?php echo T_("The form is draft"); ?></div>
                </div>
              </label>
            </div>
          </div>

          <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
            <div class="radio4">
              <input  id="publish" type="radio" name="status" value="publish" <?php if(\dash\data::dataRow_status() == 'publish') {echo 'checked';} ?>>
              <label for="publish">
                <div>
                  <div class="title"><?php echo T_("Publish"); ?></div>
                  <div class="addr"><?php echo T_("The form is publish"); ?></div>
                </div>
              </label>
            </div>
          </div>

          <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
            <div class="radio4">
              <input  id="expire" type="radio" name="status" value="expire" <?php if(\dash\data::dataRow_status() == 'expire') {echo 'checked';} ?>>
              <label for="expire">
                <div>
                  <div class="title"><?php echo T_("Expire"); ?></div>
                  <div class="addr"><?php echo T_("The form is expire"); ?></div>
                </div>
              </label>
            </div>
          </div>

          <div class="c-xs-12 c-sm-6 c-md-4 c-xl-3">
            <div class="radio4">
              <input  id="trash" type="radio" name="status" value="trash" <?php if(\dash\data::dataRow_status() == 'trash') {echo 'checked';} ?>>
              <label for="trash">
                <div>
                  <div class="title"><?php echo T_("Trash"); ?></div>
                  <div class="addr"><?php echo T_("Move to trash"); ?></div>
                </div>
              </label>
            </div>
          </div>



        </div>
		</div>
		<?php if(\dash\data::dataRow_status() == 'trash') { ?>
			<footer class="txtRa">
				<div class="linkDel btn" data-confirm data-data='{"status" : "deleted"}'><?php echo T_("Delete completely") ?></div>
			</footer>
		<?php } ?>
	</div>
</form>
	</div>
</div>
