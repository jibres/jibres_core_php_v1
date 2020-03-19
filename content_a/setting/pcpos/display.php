<div class="f">
  <div class="c5 s12 pRa10">

    <div class="cbox">
     <form method="post" autocomplete="off">
      <h2><?php echo T_("Add new pos to you store"); ?></h2>

      <select name="pos" class="select22">
        <option></option>
        <option value="saderat"><?php echo T_("Saderat"); ?></option>
        <option value="mellat"><?php echo T_("Mellat"); ?></option>
        <option value="tejarat"><?php echo T_("Tejarat"); ?></option>
        <option value="melli"><?php echo T_("Melli"); ?></option>
        <option value="sepah"><?php echo T_("Sepah"); ?></option>
        <option value="keshavarzi"><?php echo T_("Keshavarzi"); ?></option>
        <option value="parsian"><?php echo T_("Parsian"); ?></option>
        <option value="maskan"><?php echo T_("Maskan"); ?></option>
        <option value="refah"><?php echo T_("Refah"); ?></option>
        <option value="novin"><?php echo T_("Novin"); ?></option>
        <option value="ansar"><?php echo T_("Ansar"); ?></option>
        <option value="pasargad"><?php echo T_("Pasargad"); ?></option>
        <option value="saman"><?php echo T_("Saman"); ?></option>
        <option value="sina"><?php echo T_("Sina"); ?></option>
        <option value="post"><?php echo T_("Post"); ?></option>
        <option value="ghavamin"><?php echo T_("Ghavamin"); ?></option>
        <option value="taavon"><?php echo T_("Taavon"); ?></option>
        <option value="shahr"><?php echo T_("Shahr"); ?></option>
        <option value="ayande"><?php echo T_("Ayande"); ?></option>
        <option value="sarmayeh"><?php echo T_("Sarmayeh"); ?></option>
        <option value="day"><?php echo T_("Day bank"); ?></option>
        <option value="hekmat"><?php echo T_("Hekmat"); ?></option>
        <option value="iranzamin"><?php echo T_("Iranzamin"); ?></option>
        <option value="karafarin"><?php echo T_("Karafarin"); ?></option>
        <option value="gardeshgari"><?php echo T_("Gardeshgari"); ?></option>
        <option value="madan"><?php echo T_("Madan"); ?></option>
        <option value="tsaderat"><?php echo T_("Tsaderat"); ?></option>
        <option value="khavarmiyane"><?php echo T_("Khavarmiyane"); ?></option>
        <option value="ivbb"><?php echo T_("Ivbb"); ?></option>
        <option value="irkish"><?php echo T_("Irkish"); ?></option>
        <option value="asanpardakht"><?php echo T_("Asanpardakht"); ?></option>
        <option value="zarinpal"><?php echo T_("Zarinpal"); ?></option>
        <option value="payir"><?php echo T_("Payir"); ?></option>
      </select>


      <label for="title"><?php echo T_("Title"); ?></label>
      <div class="input">
        <input type="text" name="title" id="title" placeholder='<?php echo T_("Title"); ?>' minlength="1" maxlength="100">
      </div>


      <div data-response='pos' data-response-where='irkish' data-response-hide>


        <div class="switch1">
         <input type="checkbox" name="irankish" id="irankish" >
         <label for="irankish"></label>
         <label for="irankish"><?php echo T_("Enable irankish PC POS"); ?></label>
        </div>

        <div class="f mT10" data-response='irankish' data-response-effect='slide'  data-response-hide >
            <label for="serial"><?php echo T_("Serial"); ?></label>
            <div class="input">
              <input type="number" name="serial" id="serial" placeholder='<?php echo T_("Serial"); ?>'  min="1" max="99999999999999999999999">
            </div>

            <label for="terminal"><?php echo T_("Terminal"); ?></label>
            <div class="input">
              <input type="number" name="terminal" id="terminal" placeholder='<?php echo T_("Terminal"); ?>'  min="1" max="99999999999999999999999">
            </div>

            <label for="receiver"><?php echo T_("Receiver"); ?></label>
            <div class="input">
              <input type="number" name="receiver" id="receiver" placeholder='<?php echo T_("Receiver"); ?>'  min="1" max="99999999999999999999999">
            </div>
        </div>

      </div>

      <div data-response='pos' data-response-where='asanpardakht' data-response-hide>

        <div class="switch1">
         <input type="checkbox" name="asanpardakht" id="asanpardakht" >
         <label for="asanpardakht"></label>
         <label for="asanpardakht"><?php echo T_("Enable asanpardakht PC POS"); ?></label>
        </div>

        <div class="f mT10" data-response='asanpardakht' data-response-effect='slide'  data-response-hide >
          <div class="c6 pLa5">
            <label for="ip"><?php echo T_("IP"); ?></label>
            <div class="input">
              <input type="text" name="ip" id="ip" placeholder='<?php echo T_("IP"); ?>'  maxlength='15'>
            </div>
          </div>


          <div class="c6 pLa5">
            <label for="port"><?php echo T_("Port"); ?></label>
            <div class="input">
              <input type="text" name="port" id="port" placeholder='<?php echo T_("Port"); ?>'  maxlength='500' disabled>
            </div>
          </div>

        </div>
      </div>


      <button class="btn block primary mT10"><?php echo T_("Add pos"); ?></button>
     </form>
    </div>


  </div>

  <?php if(\dash\data::dataTable()) {?>

  <div class="c s12">


    <table class="tbl1 v1 txtC cbox fs12">
      <thead>
        <tr class="fs09">
          <th colspan="2"><?php echo T_("Bank"); ?></th>
          <th><?php echo T_("Name"); ?></th>
          <th class="s0"><?php echo T_("Default"); ?></th>
          <th><?php echo T_("Action"); ?></th>
        </tr>
      </thead>

      <tbody>
        <?php foreach (\dash\data::dataTable() as $key => $value) {?>


        <tr <?php if(isset($value['isdefault']) && $value['isdefault']) {?> title='<?php echo T_("Is default"); ?>' class="positive" <?php } //endif ?>>
          <td class="collapsing"><span class="spay-32-<?php echo \dash\get::index($value, 'slug'); ?>"></span></td>
          <td class="collapsing txtLa">
            <span class="txtB"><?php echo T_(ucfirst(\dash\get::index($value, 'slug'))); ?></span>
            <?php if(isset($value['pcpos']) && $value['pcpos']) {?>

          <span class="badge primary"><?php echo T_("PcPos"); ?></span>
            <div class="mT10">
              <?php if(isset($value['setting']) && is_array($value['setting'])) {?>

                <?php foreach ($value['setting'] as $k => $v) {?>
                    <span class="badge light"><?php echo T_(ucfirst($k)); ?> <?php echo \dash\fit::text($v); ?></span>
                <?php } //endfor ?>

              <?php } //endif ?>
            </div>
            <?php } //endif ?>
          </td>
          <td><?php echo \dash\get::index($value, 'title'); ?></td>
          <td class="collapsing s0">
            <?php if(isset($value['isdefault']) && $value['isdefault']) {?>
                <a class="badge success"> <?php echo T_("Is default"); ?></a>
            <?php }else{ ?>
                <a href="<?php echo \dash\url::pwd(); ?>" class="badge" data-ajaxify data-method='post' data-data='{"id" : "<?php echo $value['id']; ?>", "type" : "default"}'><?php echo T_("Set as default"); ?></a>
            <?php } //endif ?>
          </td>
          <td class="collapsing">
            <div class="badge danger" data-confirm data-data='{"id":"<?php echo $value['id']; ?>", "type":"remove"}'><?php echo T_("Remove"); ?></div>
          </td>
        </tr>

        <?php } //endfor ?>

      </tbody>
    </table>




  </div>
  <?php } //endif ?>
</div>
