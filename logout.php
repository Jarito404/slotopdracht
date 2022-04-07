<?php
session_start();
session_destroy();
?>

<script>
  window.location.replace('/');
</script>

<input class="button" type="button" value="LOGOUT" onclick="logout()"></button>