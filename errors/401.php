<?php
include '../includes/links.php';
?>

<!DOCTYPE html>
<html>
<head>
 <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
 <title>401 Error <?php echo $title ?></title>
</head>
<body>

<style>
    *{ margin: 0; padding: 0; box-sizing: border-box; 
    font-family: 'Montserrat', sans-serif;}
   
   .main_body{
    width: 100%; height: 100vh; 
    background-color: #001233;
    background-repeat: no-repeat;
    background-size: 100% 100%; 
    display: flex; 
    justify-content: center;
    align-items: center;
   }
   
   .center_body{
    width: 65%;
    height: 70%;
    background-image: url('images/bg.jpg');
    background-repeat: no-repeat;
    background-size: 100% 100%;
    display: flex; 
    flex-direction: column;
    justify-content: center;
    align-items: center;
    transition: all 0.5s linear;
   }
   
   .center_body h1{
    font-size: 200px;
    color: white;
    letter-spacing: 5px;
    font-weight: 700;
    text-shadow: 10px 9px 3px #74b9ff;
    transition: all 1s linear;
   }
   
   .center_body h2{
    color: white;
    font-size: 26px;
    font-weight: 700;
    text-transform: uppercase;
   }
   
   .center_body p{
    color: white;
    font-weight: 400;
    text-align: center;
    margin: 20px auto;
   }
   
   .center_body a{
    font-size: 14px;
    text-decoration: none;
    text-transform: uppercase;
    display: inline-block;
    color: blue;
    background: #CAC0B3;
    padding: 15px 30px;
    box-shadow: 5px 4px 15px -5px #0046d5;
    border-radius: 40px;
    transition: all 0.5s linear;
   }
   
   .center_body:hover h1{
    text-shadow: 9px 6px 3px #b2bec3;
   }
   
   .center_body:hover a{
    color: white;
    background: blue;
   }
</style>

<div class="main_body">
 <div class="center_body">
  <h1>401</h1>
  <h2>UNAUTHORIZED USER</h2>
  <p>You Don't Have Permission To Access This Page.....!!!!</p>
  <a href="<?php echo $errorsindex ?>"> go to homepage</a>
 </div>
</div>

<script>
    function setFavicons(favImg){
        let headTitle = document.querySelector('head');
        let setFavicon = document.createElement('link');
        setFavicon.setAttribute('rel','shortcut icon');
        setFavicon.setAttribute('href',favImg);
        headTitle.appendChild(setFavicon);
    }
    setFavicons('<?php echo $errorsicon ?>');
</script>

</body>

</html>