<?php 


if(empty($_SESSION['sellerid']))
{

  ?><script>

          window.location = 'login.php?err=Session has been expired';
          </script>
          <?php
    exit;
}
?>


