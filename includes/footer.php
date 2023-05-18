<?php
error_reporting(0);
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../alert/iziToast-master/dist/css/iziToast.min.css">
    <title>Document</title>
</head>
<body>
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
</body>
</html>