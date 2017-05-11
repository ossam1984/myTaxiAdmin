<div class="footer" style="position: relative;">
      <div class="container" style="text-align: right;direction: rtl;">

        <a href="http://brocaller.com/<?php print $lang?>/pages/how" style="font-size: 12px;"><img src="<?php print asset('files/images/header/how.png')?>" style="margin: 3px 0px 2px 10px;"><?php print trans("How to use")?></a>


        <a href="http://brocaller.com/<?php print $lang?>/pages/video" style="font-size: 12px;"><img src="<?php print asset('files/images/header/video.png')?>" style="margin: 3px 10px 2px 10px;width: 14px;"><?php print trans("Videos")?></a>

        <a href="http://brocaller.com/<?php print $lang?>/pages/faq" style="font-size: 12px;"><img src="<?php print asset('files/images/header/faq.png')?>" style="margin: 3px 10px 2px 10px;"><?php print trans("Faqs") ?></a>

        <a href="http://brocaller.com/<?php print $lang?>/pages/testimonials" style="font-size: 12px;"><img src="<?php print asset('files/images/header/testimonials.png')?>" style="margin: 3px 10px 2px 10px;"><?php print trans("Testimonials") ?></a>

        <a href="http://brocaller.com/<?php print $lang?>/pages/about" style="font-size: 12px;"><img src="<?php print asset('files/images/header/about.png')?>" style="margin: 3px 10px 2px 8px;"><?php print trans("About us")?></a>


        <a href="http://brocaller.com/<?php print $lang?>/pages/contact" style="font-size: 12px;"><img src="<?php print asset('files/images/header/support.png')?>" style="margin: 3px 10px 2px 10px;"><?php print trans("Contact us")?></a>





        <br>
        <font style="font-size: 10px;color: rgba(132, 132, 132, 0.34);//font-family: cursive;">
          <a href="http://brocaller.com/<?php print $lang?>/pages/languages"> <?php print trans("Languages")?></a> &nbsp;&nbsp; |
          <a href="http://brocaller.com/<?php print $lang?>/pages/terms"> <?php print trans("Privacy Policy")?></a> &nbsp;&nbsp; |
          <a href="http://brocaller.com/<?php print $lang?>/pages/privacy"> <?php print trans("Our terms")?></a> &nbsp;&nbsp; |
          <a href="http://brocaller.com/<?php print $lang?>/pages/refund"> <?php print trans("Refund Policy")?></a> &nbsp;&nbsp; |
          <a href="http://brocaller.com/<?php print $lang?>/pages/sitemap"><?php print trans("Site map")?></a> &nbsp;&nbsp; |
          <!-- <a href="spam-numbers.html"> <?php print trans("Locked Number")?></a></font> -->


      </div>

    </div>

    </div>
  <!--===============-->


  <!-- Accordion - END -->
  <!--<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/121761/card.js'></script>
<script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/121761/jquery.card.js'></script>-->

  <script src="<?php print asset('files/js/jquery.min.js')?>"></script>
  <script src="<?php print asset('files/js/card.js')?>"></script>
  <script src="<?php print asset('files/js/jquery.card.js')?>"></script>
  <script src="<?php print asset('files/js/index.js')?>"></script>
</body>


<!--  H1 can have 2 designs: "logo" and "logo cursive"           -->
<script src="<?php print asset('files/js/bootstrap.min.js')?>" type="text/javascript"></script>
<script>
var b = true;
$(".checkout_form .checkout-input").focus(function(){
  // alert("Welcom to our website")
  if(b)
  $(".accordion-toggle").trigger("click");
  else
  $(".accordion-toggle.collapsed").trigger("click");

  b=false;
})

$(".here_inputs input").blur(function(){
  // alert($(this.val))
  // alert($(this).val())
  if($(this).val().replace(/\s+/g, '')===""){
    $(this).addClass("required");
  }
  else{
   $(this).removeClass("required"); 
  }
  return false;
});
$(".here_inputs input").change(function(tr){
  console.log(tr)
});
</script>
</html>