<?php
if (empty($_SESSION['superid'])) {
?><script>
    window.location = 'index.php?err=Session has been expired';
  </script>
<?php
  exit;
}
?>