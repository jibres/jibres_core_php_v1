<?php
  if(\dash\data::productFilterList()) {?>
  <p><?php echo T_("Show all products where"); ?></p>
    <div class="mB20">

    <?php $first = true; $myClass = null; $lastGroup = null; foreach (\dash\data::productFilterList() as $key => $value) {?>
    <?php if($lastGroup !== $value['group']) { $lastGroup = $value['group']; if(!$first) { if(\dash\request::is_pwa()) { $myClass = null; echo '<div class="block"></div>'; }else{ $myClass = 'mLa10'; } } } //endif ?>
      <a class='btn <?php echo $myClass; ?>  <?php if(\dash\get::index($value, 'is_active')) { echo 'primary2'; }else{ echo 'light';}?>  mB10 ' href="<?php echo \dash\url::that(). '?'. \dash\get::index($value, 'query_string'); ?>"><?php echo \dash\get::index($value, 'title'); ?></a>
      <?php $myClass = null; $first = false; ?>
    <?php } //endfor ?>
    </div>
      <div class="mB10">
        <div class="row align-center">
          <div class="c"><label for='cat'><?php echo T_("Category"); ?></label></div>
          <div class="c-auto os"><a class="font-12"<?php if(!\dash\detect\device::detectPWA()) { echo " target='_blank' ";} ?>href="<?php echo \dash\url::here(); ?>/category"><?php echo T_("Manage"); ?> <i class="sf-link-external"></i></a></div>
        </div>

        <div>
         <select name="catid" id="cat" class="select22" data-model="tag" data-placeholder="<?php echo T_("Select one category") ?>">
          <?php if(\dash\request::get('catid')) {?>
            <option value="0"><?php echo T_("Non") ?></option>
          <?php }else{?>
            <option value="" readonly></option>
          <?php } //endif ?>
          <?php foreach (\dash\data::listCategory() as $key => $value) {?>
            <option value="<?php echo $value['id']; ?>" <?php if(\dash\request::get('catid') === $value['id']){echo 'selected';} ?>><?php echo $value['title']; ?></option>
          <?php } //endfor ?>
        </select>
        </div>
      </div>

      <div class="row align-center">
          <div class="c"><label for='tag'><?php echo T_("Tag"); ?></label></div>
          <div class="c-auto os"><a class="font-12"<?php if(!\dash\detect\device::detectPWA()) { echo " target='_blank' ";} ?>href="<?php echo \dash\url::here(); ?>/tag"><?php echo T_("Manage"); ?> <i class="sf-link-external"></i></a></div>
        </div>
      <div>
         <select name="tagid" id="tag" class="select22" data-model="tag" data-placeholder="<?php echo T_("Select one tag") ?>">
          <?php if(\dash\request::get('tagid')) {?>
            <option value="0"><?php echo T_("Non") ?></option>
          <?php }else{?>
            <option value="" readonly></option>
          <?php } //endif ?>
          <?php foreach (\dash\data::allTagList() as $key => $value) {?>
            <option value="<?php echo $value['id']; ?>" <?php if(\dash\request::get('tagid') === $value['id']){echo 'selected';} ?>><?php echo $value['title']; ?></option>
          <?php } //endfor ?>
        </select>
      </div>

       <div class="mB10">
        <div class="row align-center">
          <div class="c"><label for='unit'><?php echo T_("Unit"); ?></label></div>
          <div class="c-auto os"><a class="font-12"<?php if(!\dash\detect\device::detectPWA()) { echo " target='_blank' ";} ?>href="<?php echo \dash\url::here(); ?>/units"><?php echo T_("Manage"); ?> <i class="sf-link-external"></i></a></div>
        </div>
        <select name="unitid" id="unit" class="select22" data-model='tag' data-placeholder='<?php echo T_("like Qty, kg, etc"); ?>' <?php if(\dash\data::productDataRow_parent()) echo 'disabled'; ?> >
            <?php if(\dash\request::get('unitid')) {?>
            <option value="0"><?php echo T_("Non") ?></option>
          <?php }else{?>
            <option value="" readonly></option>
          <?php } //endif ?>
            <?php foreach (\dash\data::listUnits() as $key => $value) {?>
              <option value="<?php echo $value['id']; ?>" <?php if(\dash\request::get('unitid') === $value['id']){echo 'selected';} ?>  ><?php echo $value['title']; ?></option>
            <?php } //endfor ?>
        </select>
      </div>

      <div class="mB10">
        <div class="row align-center">
          <div class="c"><label for='company'><?php echo T_("Brand"); ?></label></div>
          <div class="c-auto os"><a class="font-12"<?php if(!\dash\detect\device::detectPWA()) { echo " target='_blank' ";} ?>href="<?php echo \dash\url::here(); ?>/company"><?php echo T_("Manage"); ?> <i class="sf-link-external"></i></a></div>
        </div>
        <select name="companyid" id="company" class="select22" data-model="tag" data-placeholder='<?php echo T_("Product Brand"); ?>'>
          <?php if(\dash\request::get('companyid')) {?>
            <option value="0"><?php echo T_("Non") ?></option>
          <?php }else{?>
            <option value="" readonly></option>
          <?php } //endif ?>
            <?php foreach (\dash\data::listCompanies() as $key => $value) {?>
            <option value="<?php echo $value['id']; ?>" <?php if(\dash\request::get('companyid') === $value['id']){echo 'selected';} ?> ><?php echo $value['title']; ?></option>
          <?php } //endfor ?>

        </select>
      </div>

      <div class="mB10">
        <label for='status'><?php echo T_("Status"); ?></label>
        <select name="status" id="status" class="select22" data-placeholder='<?php echo T_("Product Status"); ?>'>
          <?php if(\dash\request::get('status')) {?>
            <option value="0"><?php echo T_("Non") ?></option>
          <?php }else{?>
            <option value="" readonly></option>
          <?php } //endif ?>
            <?php foreach (['available','unavailable','soon','discountinued', 'archive', 'deleted'] as $value) {?>
            <option value="<?php echo $value; ?>" <?php if(\dash\request::get('status') === $value){echo 'selected';} ?> ><?php echo T_(ucfirst($value)); ?></option>
          <?php } //endfor ?>

        </select>
      </div>



      <div class="f font-12">
        <div class="cauto">
          <?php $total_rows = \dash\utility\pagination::get_total_rows(); ?>
          <div class="fc-mute mA10"><span class="txtB"><?php echo \dash\fit::number($total_rows); ?></span> <?php echo T_("Product founded") ?></div>
        </div>
        <div class="c"></div>
        <div class="cauto">
          <?php if(\dash\request::get()) {?>
            <a class="btn outline" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
          <?php }//endif ?>
          <button class="btn primary"><?php echo T_("Apply"); ?></button>
        </div>
      </div>

<?php } //endfunction ?>
