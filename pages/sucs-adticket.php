<?php
session_start();
if(isset($_SESSION['user-id'])) {

include_once '../layout/top_side-us.php';
?>

<div class="sucss_div">
    <h1>Your message is sent!</h1>
</div><br />
<div class="sucss_div">
    <a href="tickets-us.php" id="btn_back"  >Back to Tickets</a>
</div>

<?php include_once '../layout/bottom.php'; ?>
<?php
}else{
    header("Location: login.php");
}?>

