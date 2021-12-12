<?php
session_start();
$usertype = $_SESSION['usertype'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://kit.fontawesome.com/b2b14a414e.js"></script>
  <meta charset="UTF-8">
  <title>AssiSTU</title>
  <link rel="stylesheet" href="../subjects.css">
  <link rel="stylesheet" href="../../table.css">

</head>


<body>
  <!-- navbar code -->

  <div class="navbar">
    <div id="dsppt" class="pptbook">
      <i class="fas fa-file-alt"></i>
      <span>ppts</span>
    </div>
    <div id="dsref" class="pptbook">
      <i class="fas fa-align-justify"></i>
      <span>refrence</span>
    </div>
  </div>

  <!-- default/ppt code -->

  <div class="container" id="dscontainer">
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'assistu');
    if ($usertype == 'c') {
      if (isset($_POST['teach'])) {
        $modu = $_POST['modu'];
        $teach = $_POST['teach'];

        if (isset($_POST['save'])) {
          $filename = $_FILES['myfile']['name'];
          $destination = '../../uploads/' . $filename;
          $extension = pathinfo($filename, PATHINFO_EXTENSION);
          $file = $_FILES['myfile']['tmp_name'];

          if (!in_array($extension, ['zip', 'pdf', 'docx', 'pptx', 'ppt'])) {
            echo "You file extension must be .zip, .pdf or .docx or.pptx or.ppt";
          } else {
            if (move_uploaded_file($file, $destination)) {
              $sql = "INSERT INTO `dsppt`(`module`, `teacher`, `name`) VALUES ('$modu','$teach','$filename')";
              if (mysqli_query($conn, $sql)) {
                echo "<script>alert('uploaded successfully');</script>";
              }
            } else {
              echo "Failed to upload file.";
            }
          }
        }
      } ?>
      <div class="row">
        <form action="ds.php" method="post" enctype="multipart/form-data">
          <h3>Upload File</h3>
          <label for="myfile">file name</label>
          <input type="file" name='myfile'> <br>
          <label for="modu">module</label>
          <input type="text" name='modu'> <br>
          <label for="teach">teacher</label>
          <input type="text" name='teach'> <br>
          <button type="submit" name="save">upload</button>
        </form>
      </div>
    <?php
    }
    ?>

    <table>
      <thead>
        <th>MODULE</th>
        <th>TEACHER</th>
        <th>FILE NAME</th>
        <th></th>
      </thead>
      <tbody>
        <?php
        $querry = mysqli_query($conn, "SELECT * FROM dsppt");
        while ($val = mysqli_fetch_array($querry)) {
        ?>

          <tr>
            <th><?php echo $val["module"]; ?></th>
            <th><?php echo $val["teacher"]; ?></th>
            <th><?php echo $val["name"]; ?></th>
            <th><a download="<?php echo $val['name']; ?>" href="../../uploads/<?php echo $val['name']; ?>">download</a></th>
          </tr>

        <?php
        }
        mysqli_close($conn);
        ?>

      </tbody>
    </table>

    <!-- refrence code -->

    <div hidden>
      <div id="dsrefcont">
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'assistu');
        if ($usertype == 'c') {
          if (isset($_POST['save'])) {
            $filename = $_FILES['myfile']['name'];
            $destination = '../../uploads/' . $filename;
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $file = $_FILES['myfile']['tmp_name'];

            if (!in_array($extension, ['zip', 'pdf', 'docx', 'pptx', 'ppt'])) {
              echo "You file extension must be .zip, .pdf or .docx or.pptx or.ppt";
            } else {
              if (move_uploaded_file($file, $destination)) {
                $sql = "INSERT INTO `dsref`(`name`) VALUES ('$filename')";
                if (mysqli_query($conn, $sql)) {
                  echo "<script>alert('uploaded successfully');</script>";
                }
              } else {
                echo "Failed to upload file.";
              }
            }
          }
        ?>
          <div class="row">
            <form onsubmit="false" method="post" enctype="multipart/form-data">
              <h3>Upload File</h3>
              <label for="myfile">file name</label>
              <input type="file" name='myfile'> <br>
              <button type="submit" name="save">upload</button>
            </form>
          </div>
        <?php
        }
        ?>

        <table>
          <thead>
            <th>FILE NAME</th>
            <th></th>
          </thead>
          <tbody>
            <?php
            $querry = mysqli_query($conn, "SELECT * FROM dsref");
            while ($val = mysqli_fetch_array($querry)) {
            ?>
              <tr>
                <th><?php echo $val["name"]; ?></th>
                <th><a download="<?php echo $val['name']; ?>" href="../../uploads/<?php echo $val['name']; ?>">download</a></th>
              </tr>
            <?php
            }
            mysqli_close($conn);
            ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>


  <script>
    container = document.querySelector("#dscontainer");
    ppthtml = container.innerHTML;
    pptb = document.querySelector("#dsppt");
    pptb.addEventListener('click', function() {
      console.log("clicekd ppt");
      container.innerHTML = ppthtml;
    });

    refb = document.querySelector("#dsref");
    refb.addEventListener('click', function() {
      container.innerHTML = document.querySelector("#dsrefcont").innerHTML;
    });
  </script>

</body>

</html>