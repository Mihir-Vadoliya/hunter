<?php 


if(empty($_SESSION['miniadmin_id']))
{

  ?><script>

          window.location = 'login.php?err=Session has been expired';
          </script>
          <?php
    exit;
}
?>

