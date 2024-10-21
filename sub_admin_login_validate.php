<?php
if (empty($_SESSION['subid'])) {
?><script>
    window.location = 'index.php?err=Session has been expired';
  </script>
<?php
  exit;
}
?>