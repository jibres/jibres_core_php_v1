<form method="post" autocomplete="off">

<div class="avand-md">

  <div  class="box impact mB25-f">
    <header><h2><?php echo T_("Set Order Text");?></h2></header>
      <div class="body">
        <p><?php echo T_("After this time, any unpaid orders will expire");?></p>
        <div class="c4 s12" method="post" autocomplete="off">
          <div class="action f">


            <div class="c12 mB5">
              <label for="page_text"><?php echo T_("Order validity time"); ?></label>
              <div>
                <select name="life_time" class="select22">
                  <option value="0"><?php echo T_("Default (Never expire order)"); ?></option>
                  <option value="<?php $time = (60*60*1); echo $time; ?>" <?php if(\dash\data::orderSettingSaved_life_time() == $time) { echo 'selected'; } ?>><?php echo T_("1 hour"); ?></option>
                  <option value="<?php $time = (60*60*3); echo $time; ?>" <?php if(\dash\data::orderSettingSaved_life_time() == $time) { echo 'selected'; } ?>><?php echo T_("3 hour"); ?></option>
                  <option value="<?php $time = (60*60*5); echo $time; ?>" <?php if(\dash\data::orderSettingSaved_life_time() == $time) { echo 'selected'; } ?>><?php echo T_("5 hour"); ?></option>
                  <option value="<?php $time = (60*60*10); echo $time; ?>" <?php if(\dash\data::orderSettingSaved_life_time() == $time) { echo 'selected'; } ?>><?php echo T_("10 hour"); ?></option>
                  <option value="<?php $time = (60*60*24*1); echo $time; ?>" <?php if(\dash\data::orderSettingSaved_life_time() == $time) { echo 'selected'; } ?>><?php echo T_("1 Day"); ?></option>
                  <option value="<?php $time = (60*60*24*3); echo $time; ?>" <?php if(\dash\data::orderSettingSaved_life_time() == $time) { echo 'selected'; } ?>><?php echo T_("3 Day"); ?></option>
                  <option value="<?php $time = (60*60*24*5); echo $time; ?>" <?php if(\dash\data::orderSettingSaved_life_time() == $time) { echo 'selected'; } ?>><?php echo T_("5 Day"); ?></option>
                  <option value="<?php $time = (60*60*24*10); echo $time; ?>" <?php if(\dash\data::orderSettingSaved_life_time() == $time) { echo 'selected'; } ?>><?php echo T_("10 Day"); ?></option>
                  <option value="<?php $time = (60*60*24*30); echo $time; ?>" <?php if(\dash\data::orderSettingSaved_life_time() == $time) { echo 'selected'; } ?>><?php echo T_("30 Day"); ?></option>
                </select>
              </div>
            </div>


          </div>
        </div>
      </div>
      <footer class="txtRa">
        <button  class="btn success" ><?php echo T_("Save"); ?></button>
      </footer>
  </div>

</div>

</form>