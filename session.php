<?php
session_start();
   
   
if (($_SESSION['logged_in']) != true)
{
    echo '<script>
  window.location.href = "index.php";
</script>';

}

?>