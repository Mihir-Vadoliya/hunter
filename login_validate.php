<?php 


if(empty($_SESSION['info']['adminid']) && empty($_SESSION['info']['miniadmin_id']) && empty($_SESSION['info']['superid']) && empty($_SESSION['info']['subid']) &&  empty($_SESSION['info']['sellerid']))
{

  ?><script>

          window.location = 'login.php?err=Session has been expired';
          </script>
          <?php
    exit;
}
?>


