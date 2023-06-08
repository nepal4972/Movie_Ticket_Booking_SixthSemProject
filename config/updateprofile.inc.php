<?php

if (isset($_POST['submit'])) {
    echo 'submit';
} elseif (isset($_POST['cancel'])) {
    echo 'cancel';
}
else {
    echo 'exit';
}

?>