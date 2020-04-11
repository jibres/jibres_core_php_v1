<div class="f">
  <div class="c pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Sale Count - Today");?></h3>
      <div class="val"><?php echo \dash\fit::number(2070);?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Sale Count - Yesterday");?></h3>
      <div class="val"><?php echo \dash\fit::number(306);?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Sale Count - Last Week");?></h3>
      <div class="val"><?php echo \dash\fit::number(129);?></div>
    </a>
  </div>
  <div class="c pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Sale Count - Last Month");?></h3>
      <div class="val"><?php echo \dash\fit::number(49350);?></div>
    </a>
  </div>
  <div class="c3 s12">
    <a href="" class="stat">
      <h3><?php echo T_("Sale Count - Total");?></h3>
      <div class="val counter"><?php echo \dash\fit::number(493350);?></div>
    </a>
  </div>
</div>

<div class="f">
  <div class="c9 s12 pRa10">
    <div id="chartdiv" class="box chart x210" data-hint='Domain buy & renew & transfer & whois & total buy in lasy 30 days'></div>
  </div>
  <div class="c3 s12">
    <a href="" class="stat">
      <h3><?php echo T_("Total Buyers");?></h3>
      <div class="val"><?php echo \dash\fit::number(128);?></div>
    </a>
    <a href="" class="stat">
      <h3><?php echo T_("Total Log");?></h3>
      <div class="val"><?php echo \dash\fit::number(2950124);?></div>
    </a>
  </div>
</div>




<div class="f">
  <div class="c3 s6 pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Total Domain Buy");?></h3>
      <div class="val"><?php echo \dash\fit::number(2070);?></div>
    </a>
  </div>
  <div class="c3 s6 pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Total Domain Renew");?></h3>
      <div class="val"><?php echo \dash\fit::number(306);?></div>
    </a>
  </div>
  <div class="c3 s6 pRa10">
    <a href="" class="stat">
      <h3><?php echo T_("Total Domain Transfer");?></h3>
      <div class="val"><?php echo \dash\fit::number(129);?></div>
    </a>
  </div>
  <div class="c3 s6">
    <a href="" class="stat">
      <h3><?php echo T_("Total Whois");?></h3>
      <div class="val"><?php echo \dash\fit::number(49350);?></div>
    </a>
  </div>
</div>


<div class="f">
  <div class="c s12 pRa10">
    <div id="chartdiv" class="box chart x320" data-hint='All API request in 10 last days'></div>

  </div>
  <div class="c3">

   <nav class="items">
     <ul>
       <li>
          <a class="f" href="<?php echo \dash\url::this();?>/all">
            <div class="key"><?php echo T_('Domains');?></div>
            <div class="go"></div>
          </a>
       </li>

       <li>
          <a class="f" href="<?php echo \dash\url::this();?>/dns">
            <div class="key"><?php echo T_('Name servers');?></div>
            <div class="go"></div>
          </a>
       </li>

       <li>
          <a class="f" href="<?php echo \dash\url::this();?>/irnic">
            <div class="key"><?php echo T_('IRNIC handlers');?></div>
            <div class="go"></div>
          </a>
       </li>
     </ul>
   </nav>

   <nav class="items">
     <ul>
       <li>
          <a class="f" href="<?php echo \dash\url::this();?>/log">
            <div class="key"><?php echo T_('Logs');?></div>
            <div class="go"></div>
          </a>
       </li>

       <li>
          <a class="f" href="<?php echo \dash\url::this();?>/polls">
            <div class="key"><?php echo T_('Polls');?></div>
            <div class="go"></div>
          </a>
       </li>
     </ul>
   </nav>

   <nav class="items">
     <ul>
       <li>
          <a class="f" href="<?php echo \dash\url::this();?>/short">
            <div class="key"><?php echo T_('Short domains');?></div>
            <div class="go"></div>
          </a>
       </li>
     </ul>
   </nav>

  </div>
</div>


