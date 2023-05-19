<?php
error_reporting(0);
session_start();    
?>
    <link rel="stylesheet" href="../alert/iziToast-master/dist/css/iziToast.min.css">
    <script src="../alert/iziToast-master/dist/js/iziToast.min.js"></script>
<?php
    if(isset($_SESSION['status']) && $_SESSION['status'] !='') {?>
<script>
iziToast.<?php echo $_SESSION['status']; ?>({
    title: '',
    message: '<?php echo $_SESSION['status_code']; ?>', 
    position: 'topRight',
});
    </script>
    <?php
        unset($_SESSION['status']);
    }
?>      