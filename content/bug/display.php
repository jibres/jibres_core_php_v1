<div class="jibresBanner">
 <div class="fit zero love">
 	<img class="block" src="<?php echo \dash\url::cdn(); ?>/img/bg/jibres-bug-1.jpg" alt='<?php echo \dash\face::title();?>'>
 </div>


 <div class="fit">
 		<h3><?php echo T_("Vulnerability Disclosure Philosophy"); ?></h3>
 		<ul class="list">
 			<li><?php echo "<b>Respect privacy.</b> Make a good faith effort not to access or destroy another user's data."; ?></li>
 			<li><?php echo "<b>Be patient.</b> Make a good faith effort to clarify and support their reports upon request."; ?></li>
 			<li><?php echo "<b>Do no harm.</b> Act for the common good through the prompt reporting of all found vulnerabilities. Never willfully exploit others without their permission."; ?></li>
 		</ul>
 </div>

<div class="fit">
	<p><?php echo "A software bug that would allow an attacker to perform an action in violation of an expressed security policy. A bug that enables escalated access or privilege is a vulnerability. Design flaws and failures to adhere to security best practices may qualify as vulnerabilities. Weaknesses exploited by viruses, malicious code, and social engineering are not considered vulnerabilities"; ?></p>

	<p><?php echo T_("If you believe you have found a vulnerability, please submit a Report here. The Report should include a detailed description of your discovery with clear, concise reproducible steps or a working proof-of-concept. If you don't explain the vulnerability in detail, there may be significant delays in the disclosure process, which is undesirable for everyone. We are use CVSS v.3 calculator on Jibres."); ?> <a href="https://www.first.org/cvss/calculator/3.0"><?php echo T_("Learn more about CVSS v3 rating"); ?></a></p>

</div>


 <div class="fit">
 		<h2><?php echo T_("Submit Vulnerability Report"); ?></h2>
 		<p class="mB25"><?php echo T_("All technology contains bugs. If you've found a security vulnerability, we'd like to help out. By submitting a vulnerability to a program on Jibres. The proof of concept is the most important part of your report submission. Clear, reproducible steps will help us validate this issue as quickly as possible.") ?></p>


     <form method="post" data-clear autocomplete="off">
<?php
      \dash\utility\hive::html();
      if(!\dash\user::login())
      {
?>
        <label for="title"><?php echo T_("Title"); ?> *</label>
        <div class="input">
         <input type="text" name="title" id="title" placeholder='<?php echo T_("A clear and concise title includes the type of vulnerability and the impacted asset."); ?>' maxlength='40'>
        </div>

        <label for="iu1"><?php echo T_("Your 3"); ?></label>
        <div class="input">
         <input type="text" name="iu1" id="iu1" placeholder='<?php echo T_("Full"); ?>' maxlength='40'>
        </div>

        <label for="mobile"><?php echo T_("Mobile"); ?></label>
        <div class="input">
         <input type="tel" name="mobile" id="mobile" placeholder='98 912 333 4444' maxlength="17" autocomplete="off" data-validity='<?php echo T_("Please enter valid mobile number. `:val` is incorrect"); ?>'>
        </div>

        <label for="email"><?php echo T_("Email"); ?></label>
        <div class="input">
         <input type="email" name="email" id="email" placeholder='' maxlength='40'>
        </div>
<?php
      } // endif
?>
      <div>
       <label for="content"><?php echo T_("Description"); ?> *</label>
       <textarea class="txt" name="content" id="contenct" placeholder='<?php echo T_("What is the vulnerability? In clear steps, how do you reproduce it?"); ?>' rows="10" minlength="5" maxlength="1000" data-resizable></textarea>
      </div>

      <button type="submit" name="submit-contact" class="btn block success mT25"><?php echo T_("Send"); ?></button>
     </form>



 </div>

</div>
<canvas id="matrix"/>
<script src='<?php echo \dash\url::cdn(); ?>/js/page/matrix.js'></script>