

  <div class="box">
    <div class="pad">
      <label for="status"><?php echo T_("Status") ?></label>
      <div>
        <select class="select22" name="status" id="status">
          <option value="draft" <?php if(\dash\data::productDataRow_status() === 'draft') {echo 'selected';} ?>><?php echo T_("Draft") ?></option>
          <option value="active" <?php if(\dash\data::productDataRow_status() === 'active') {echo 'selected';} ?>><?php echo T_("Active") ?></option>
          <?php if(\dash\data::productDataRow_status() === 'archive') { ?>
            <option value="archive" <?php if(\dash\data::productDataRow_status() === 'archive') {echo 'selected';} ?>><?php echo T_("Archive") ?></option>
          <?php } //endif ?>
          <?php if(\dash\data::productDataRow_status() === 'deleted') { ?>
            <option value="deleted" <?php if(\dash\data::productDataRow_status() === 'deleted') {echo 'selected';} ?>><?php echo T_("Deleted") ?></option>
          <?php } //endif ?>
        </select>
      </div>
      <div class="check1">
        <input type="checkbox" name="saleonline" id="saleonline" <?php if(\dash\data::productDataRow_saleonline() === 'yes' ||  !\dash\data::productDataRow()) {echo 'checked';} ?>>
        <label for="saleonline"><?php echo T_("Active in Online Store") ?></label>
      </div>

    </div>
  </div>

  <div class="box">
    <div class="pad">
    <?php if(\dash\data::countOrdered_count()) {?>
      <p><?php echo T_(":total items of this product have been sold in :count factors", ['total' => \dash\fit::number(\dash\data::countOrdered_total()), 'count' => \dash\fit::number(\dash\data::countOrdered_count())]) ?></p>
      <div class="txtRa">
        <a class="btn-link" href="<?php echo \dash\url::here(); ?>/order?product=<?php echo \dash\request::get('id'); ?>"><?php echo T_("View factors") ?></a>
      </div>
    <?php }else{ ?>
      <p class="mB0-f"><?php echo T_("This product has not been sold yet!") ?></p>
    <?php } //endif ?>
    </div>
  </div>

 <nav class="items long">
    <ul>
      <?php if(\dash\detect\device::detectPWA()) {?>
        <li>
          <a class="item f" href="<?php echo \dash\url::this().'/desc?id='. \dash\request::get('id'); ?>">
            <?php echo \dash\utility\icon::svg('Text Block'); ?>
            <div class="key"><?php echo T_("Edit Description") ?></div>
            <div class="go"></div>
          </a>
        </li>
      <?php } //endif ?>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(); ?>/property?id=<?php echo a($productDataRow,'id'); ?>">
          <?php echo \dash\utility\icon::svg('Checklist Alternate'); ?>
          <div class="key"><?php echo T_("Product Properties"); ?></div>
          <div class="value"><?php echo \dash\fit::number(\dash\data::propertyCount()); ?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(); ?>/advance?id=<?php echo a($productDataRow,'id'); ?>">
          <?php echo \dash\utility\icon::svg('package'); ?>
          <div class="key"><?php echo T_("Advance"); ?></div>
          <div class="value"><?php ?></div>
          <div class="go"></div>
        </a>
      </li>



    </ul>
  </nav>


  <nav class="items long">
    <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(); ?>/comment?id=<?php echo \dash\request::get('id'); ?>">
          <?php echo \dash\utility\icon::svg('Conversation', 'minor'); ?>
          <div class="key"><?php echo T_("Comments"); ?></div>
          <div class="value"><?php echo \dash\fit::number(\dash\data::commentCount()); ?></div>
          <div class="go"></div>
        </a>
      </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::here(); ?>/pricehistory?id=<?php echo \dash\request::get('id'); ?>">
            <?php echo \dash\utility\icon::svg('Analytics'); ?>
            <div class="key"><?php echo T_("Price change chart"); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <?php if(\dash\permission::supervisor()) : ?>
        <li>
            <a class="item f" href="<?php echo \dash\url::this(); ?>/inventory?id=<?php echo \dash\request::get('id'); ?>">
				<?php echo \dash\utility\icon::svg('Transaction', 'major'); ?>
                <div class="key"><?php echo T_("Product inventory history"); ?></div>
                <div class="go"></div>
            </a>
        </li>
        <?php endif; // supervisor ?>

    </ul>
  </nav>

  <nav class="items long">
    <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(); ?>/share?id=<?php echo \dash\request::get('id'); ?>">
            <?php echo \dash\utility\icon::svg('Affiliate'); ?>
            <div class="key"><?php echo T_("Smart Share"); ?></div>
            <div class="go fc-fb"></div>
          </a>
        </li>
    </ul>
  </nav>

      <?php if(!\dash\data::productFamily()) {?>
  <?php if(!$have_variant_child) {?>
      <nav class="items long">
        <ul>
          <li>
            <a class="item f" href="<?php echo \dash\url::this(); ?>/variants?id=<?php echo a($productDataRow,'id'); ?>">
              <?php echo \dash\utility\icon::svg('Collections'); ?>
              <div class="key"><?php echo T_("Make product variants"); ?></div>
              <div class="value"><?php if(count($child_list)) { echo \dash\fit::number(count($child_list)); } ?></div>
              <div class="go"></div>
            </a>
          </li>
        </ul>
      </nav>
    <?php } //endif ?>
      <?php if($have_variant_child) {?>
        <nav class="items long">
        <ul>
          <li>
            <a class="item f" href="<?php echo \dash\url::this(); ?>/child?id=<?php echo a($productDataRow,'id'); ?>">
              <?php echo \dash\utility\icon::svg('Collections'); ?>
              <div class="key"><?php echo T_("Manage variants"); ?></div>
              <div class="value"><?php if(count($child_list)) { echo \dash\fit::number(count($child_list));} ?></div>
              <div class="go"></div>
            </a>
          </li>
        </ul>
      </nav>
      <?php } //endif ?>

  <?php } //endif ?>
