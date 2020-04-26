
<div class="f mB10">
   <div class="c6 s6">
    <a class="dcard x1" href='<?php echo \dash\url::here(); ?>/customer/add'>
     <div class="statistic teal">
      <div class="value"><i class="sf-user-plus"></i></div>
      <div class="label"><?php echo T_("Add new customer"); ?></div>
     </div>
    </a>
   </div>
   <div class="c6 s6">
    <a class="dcard x1" href='<?php echo \dash\url::here(); ?>/customer'>
     <div class="statistic">
      <div class="value"><i class="sf-users"></i></div>
      <div class="label"><?php echo T_("Customer list"); ?></div>
     </div>
    </a>
   </div>
</div>
<br>
<br>
<br>
<br>
<br>

<div class="f justify-center">
  <div class="cauto">
    <a href="<?php echo \dash\url::this(); ?>/log" class="btn">Show log</a>
  </div>
</div>
<div class="fs12">
  <h3>Transfer</h3>
  <hr>
  <a class="btn txtC" href="<?php echo \dash\url::this(); ?>?transfer=1">Start Transfer</a>
</div>
<div class="fs12">
  <h3>Write</h3>
  <hr>

  <table class="tbl1 v1">
    <thead>
      <tr class="fs07">
        <th></th>
        <th>Jibres - Evazzadeh</th>
        <th>Reza Mohiti</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>Step 1 <small>define Customer and shop</small></th>
        <td><a target="_blank" href="<?php echo \dash\url::this(); ?>/write/step1?sample=1" class="btn">Go 1</a></td>
        <td><a target="_blank" href="<?php echo \dash\url::this(); ?>/write/step1?sample=2" class="btn">Go 2</a></td>
      </tr>
      <tr>
        <th>Step 2 <small>define new payane or pazirande</small></th>
        <td><a target="_blank" href="<?php echo \dash\url::this(); ?>/write/step2?sample=1" class="btn">Go 1</a></td>
        <td><a target="_blank" href="<?php echo \dash\url::this(); ?>/write/step2?sample=2" class="btn">Go 2</a></td>
      </tr>
      <tr>
        <th>Step 3 <small>change shaba</small></th>
        <td><a target="_blank" href="<?php echo \dash\url::this(); ?>/write/step3?sample=1" class="btn">Go 1</a></td>
        <td><a target="_blank" href="<?php echo \dash\url::this(); ?>/write/step3?sample=2" class="btn">Go 2</a></td>
      </tr>
      <tr>
        <th>Step 4 <small>disable payane</small></th>
        <td><a target="_blank" href="<?php echo \dash\url::this(); ?>/write/step4?sample=1" class="btn">Go 1</a></td>
        <td><a target="_blank" href="<?php echo \dash\url::this(); ?>/write/step4?sample=2" class="btn">Go 2</a></td>
      </tr>
      <tr>
        <th>Step 5 <small>enable payane</small></th>
        <td><a target="_blank" href="<?php echo \dash\url::this(); ?>/write/step5?sample=1" class="btn">Go 1</a></td>
        <td><a target="_blank" href="<?php echo \dash\url::this(); ?>/write/step5?sample=2" class="btn">Go 2</a></td>
      </tr>
      <tr>
        <th>Step 6 <small>change shop</small></th>
        <td><a target="_blank" href="<?php echo \dash\url::this(); ?>/write/step6?sample=1" class="btn">Go 1</a></td>
        <td><a target="_blank" href="<?php echo \dash\url::this(); ?>/write/step6?sample=2" class="btn">Go 2</a></td>
      </tr>
      <tr>
        <th>Step 7 <small>edit data</small></th>
        <td><a target="_blank" href="<?php echo \dash\url::this(); ?>/write/step7?sample=1" class="btn">Go 1</a></td>
        <td><a target="_blank" href="<?php echo \dash\url::this(); ?>/write/step7?sample=2" class="btn">Go 2</a></td>
      </tr>
    </tbody>
  </table>
</div>


<div class="fs14 msg">
  <h3>Read</h3>
  <hr>

  <div class="mB5">
    <a target="_blank" href="<?php echo \dash\url::this(); ?>/read/date" class="btn">Read Last Month data</a>
  </div>

  <div class="mB5">
    <a target="_blank" href="<?php echo \dash\url::this(); ?>/read/statuses" class="btn">All Status</a>
  </div>

  <div class="mB5">
    <a target="_blank" href="<?php echo \dash\url::this(); ?>/read/status14" class="btn">Status 14</a>
  </div>


  <form class="mB5 f" action="<?php echo \dash\url::this(); ?>/read/trackingNumbers" data-action target="_blank">
    <div class="c">
      <div class="input">
        <input type="number" name="num" placeholder="tracking number" value="107672914671153">
        <button class="addon btn">tracking number</button>
      </div>
    </div>
  </form>


  <form class="mB5 f" action="<?php echo \dash\url::this(); ?>/read/trackingNumberPsps" data-action target="_blank">
    <div class="c">
      <div class="input">
        <input type="number" name="num" placeholder="tracking number psp">
        <button class="addon btn">tracking number psp</button>
      </div>
    </div>
  </form>
</div>
