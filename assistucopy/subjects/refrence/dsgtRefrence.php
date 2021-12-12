<?php
session_start();
$usertype = $_SESSION['usertype'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>AssiSTU</title>
</head>

<body>
  <div class="containerass">
   
  </div>
  <script>

    usertype = '<?=$usertype?>';
    if(usertype=='c'){
      add = document.querySelector(".containerass");
      add.innerHTML=` <p>welcome cr dsgt refrence</p>`;
    }
    else
    {
      add = document.querySelector(".containerass");
      add.innerHTML=` <p>welcome student dsgt refrence</p>`;
    }
  </script>
  
  
</body>

</html>