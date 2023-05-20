<?php
error_reporting(0);
session_start();    
include './links.php';
?>
    <link rel="stylesheet" href="../alerts/dist/css/iziToast.min.css">
<?php
    if(isset($_SESSION['status']) && $_SESSION['status'] !='') {?>
<script>
iziToast.<?php echo $_SESSION['status']; ?>({
    iconUrl: '<?php echo $_SESSION['icons']; ?>',
    message: '<?php echo $_SESSION['status_code']; ?>',
    position: 'topCenter',
});
    </script>
    <?php
        unset($_SESSION['status']);
        unset($_SESSION['status_code']);
        unset($_SESSION['icons']);
    }
?>