<!--Footer-->
<div class="row bg-dark text-light" style="padding: 40px 40px" id="contact">
    Web assignment - 2020
</div>
    <!--End of Footer-->
<?php
$rootUrl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
?>
    <script src="<?php echo $rootUrl?>/Public/script/typed.min.js"></script>
    <script src="<?php echo $rootUrl?>/Public/script/homepage.js"></script>
    <script>
      $('#cart-popover').popover({
        html:true,
        container: 'body',
        content: function(){
          return $('#popover_content_wrapper').html();
        }
      })
    </script>
  </body>
</html>
