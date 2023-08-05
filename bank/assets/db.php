<?php 
    session_start();
    $con = new mysqli('localhost','root','','mybank');
    define('bankName', 'RBS Bank');
    if (isset($_SESSION['userId'])) {
    $ar = $con->query("select * from userAccounts,branch where id = '$_SESSION[userId]' AND userAccounts.branch = branch.branchId");
    $userData = $ar->fetch_assoc();
  } else {
    // handle the case where the userId is not set in the session
}
?>
<script type="text/javascript">
	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>


