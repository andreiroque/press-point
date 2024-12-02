<?php
session_start();
session_unset();
session_destroy();

echo '<script>alert("Logged out Successfully!")</script>';
echo '<script>window.location="sign-in.php"</script>';
exit();

?>