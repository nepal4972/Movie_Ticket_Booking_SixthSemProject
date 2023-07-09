
<script>
function showConfirmation(event) {
  event.preventDefault(); // Prevent the default link behavior
  
  var href = event.currentTarget.getAttribute('href'); // Get the href attribute from the clicked link
  var id = href.substring(href.indexOf('?id=') + 4); // Extract the ID from the href
  
  iziToast.question({
      overlay: true,
      toastOnce: true,
      color: 'green',
      iconUrl: '../img/alerticons/question.png',
      id: 'question',
      message: 'Are you sure?',
      position: 'topRight',
      timeout:30000,
      buttons: [
          ['<button onclick="confirmAction(event, ' + id + ')">YES</button>', function (instance, toast) {
              instance.hide({ transitionOut: 'fadeOut' }, toast);
              confirmAction(event, id);
          }],
          ['<button onclick="cancelAction()">NO</button>', function (instance, toast) {
              instance.hide({ transitionOut: 'fadeOut' }, toast);
          }]
      ]
  });
  
  return false;
}

function confirmAction(event, id) {
  window.location.href = '<?php echo $request?>?id=' + id;
}

function cancelAction() {
  console.log('cancelled');
  iziToast.warning({
      color: 'red',
      message: 'cancelled.',
      iconUrl: '../img/alerticons/info.png',
      position: 'topRight', // Show the message at the top-right corner
      timeout: 5000 // Set the timeout to 5 seconds (5000 milliseconds)
  });
}
</script>