<?php
session_start();
$usertype = $_SESSION['usertype'];
?>


<!DOCTYPE html>
<html lang="en">

<head>




  <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="subjects/subjects.css">
  <link rel="stylesheet" href="table.css">
    <script src="https://kit.fontawesome.com/b2b14a414e.js"></script>
    <title>AssiSTU</title>


</head>

<body>

  <!-- navbar code -->
  <div class="navbar">
    <div id="assignments" class="pptbook">
      <i class="fas fa-file-alt"></i>
      <span>Assignments</span>
    </div>
    <div id="notices" class="pptbook">
      <i class="fas fa-align-justify"></i>
      <span>Notices</span>
    </div>
    <div id="subjects" class="pptbook">
      <i class="fas fa-book-open"></i>
      <span>Subjects</span>
    </div>
  </div>

  <!-- default/subjects code -->
<div class="card">
  <div class="container" >
    <div class="row justify-content-center">
      <a href="subjects/CG/cg.php" class="col-lg-3 subject">
        <img src="assets/cg.png" alt="subject image" />
        <span>Computer Graphics</span>
      </a>
      <a href="subjects/DLCA/dlca.php" class="col-lg-3 subject">
        <img src="assets/dlca.png" alt="subject image" />
        <span>Digital Logic <br />Computer Architecture</span>
      </a>
      <a href="subjects/DS/ds.php" class="col-lg-3 subject">
        <img src="assets/ds.png" alt="subject image" />
        <span>Data Structure</span>
      </a>
      <a href="subjects/DSGT/dsgt.php" class="col-lg-3 subject">
        <img src="assets/dsgt.png" alt="subject image" />
        <span>Discrete Structures <br />Graph Theory</span>
      </a>
      <a href="subjects/EM/em.php" class="col-lg-3 subject">
        <img src="assets/maths.png" alt="subject image" />
        <span>Engineering Mathematics</span>
      </a>
      <a href="subjects/OOP/oop.php" class="col-lg-3 subject">
        <img src="assets/java.png" alt="subject image" />
        <span>Object Oriented Programming</span>
      </a>
    </div>
  </div>
  
  <!-- assignment code -->

  <div hidden id="assignmnetscode">
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'assistu');
    if ($usertype == 'c') {
      if (isset($_POST['save'])and($_POST['discription'])) {
        $assdisc = $_POST['discription'];
        $sub = $_POST['sub'];
        $date = $_POST['subdate'];

        $filename = $_FILES['myfile']['name'];
        $destination = 'uploadscommon/' . $filename;
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $file = $_FILES['myfile']['tmp_name'];

        if (!in_array($extension, ['zip', 'pdf', 'docx', 'pptx', 'ppt'])) {
          echo "You file extension must be .zip, .pdf or .docx or.pptx or.ppt";
        } else {
          if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO `assignments`(`filename`, `assdisc`, `subdate`, `subject`) VALUES ('$filename','$assdisc','$date','$sub')";
            if (mysqli_query($conn, $sql)) {
              echo "<script>alert('uploaded successfully');</script>";
            }
          } else {
            echo "Failed to upload file wrong.";
          }
        }
      }

    ?>
      <div class="row">
        <form onsubmit="false"  method="post" enctype="multipart/form-data">
          <h3>Upload File</h3>
          <label for="myfile">file name</label>
          <input type="file" name='myfile'> <br>
          <label for="discription">assignment discription</label>
          <input type="text" name='discription'> <br>
          <label for="sub">subject</label>
          <input type="text" name='sub'> <br>
          <label for="subdate">submission date</label>
          <input type="date" name='subdate'> <br>
          <button type="submit" name="save">upload</button>
        </form>
      </div>
    <?php
    }
    ?>
    <div class="container">
      <div>
        <div>
          <table class="content-table">
            <thead>
              <tr>
                <th>
                  assignmentdiscription
                </th>
                <th>
                  subject
                </th>
                <th>
                  refrence material
                </th>
                <th>
                  submission date
                </th>
              </tr>
            </thead>

            <tbody>
              <?php
              $con = mysqli_connect("localhost", "root", "", "assistu");
              $querry = mysqli_query($con, "SELECT * FROM assignments");

              while ($val = mysqli_fetch_array($querry)) {
              ?>

                <tr>
                  <th><?php echo $val["assdisc"]; ?></th>
                  <th><?php echo $val["subject"]; ?></th>
                  <?php if ($val['filename'] != null) { ?>
                    <th><a download="<?php echo $val['filename']; ?>" href="uploadscommon/<?php echo $val['filename']; ?>">download</a></th>
                  <?php
                  } else {
                  ?><th></th>
                  <?php }
                  ?>
                  <th><?php echo $val["subdate"]; ?></th>
                </tr>

              <?php
              }
              mysqli_close($con);
              ?>


            </tbody>
          </table>
        </div>
      </div>

    </div>

  </div>

  <!-- notices code -->
  <div hidden id="noticescode">

    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'assistu');
    if ($usertype == 'c') {
      if (isset($_POST['save2'])) {
        $noticedisc = $_POST['discription2'];

        $filename = $_FILES['myfile2']['name'];
        $destination = 'uploadscommon/' . $filename;
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $file = $_FILES['myfile2']['tmp_name'];

        if (!in_array($extension, ['zip', 'pdf', 'docx', 'pptx', 'ppt'])) {
          echo "You file extension must be .zip, .pdf or .docx or.pptx or.ppt";
        } else {
          if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO `notice`(`name`, `notice`) VALUES ('$filename','$noticedisc')";
            if (mysqli_query($conn, $sql)) {
              echo "<script>alert('uploaded successfully');</script>";
            }
          } else {
            echo "Failed to upload file wrong.";
          }
        }
      }

    ?>
      <div class="row">
        <form onsubmit="false" method="post" enctype="multipart/form-data">
          <h3>Upload File</h3>
          <label for="myfile2">file name</label>
          <input type="file" name='myfile2'> <br>
          <label for="discription2">notice discription</label>
          <input type="text" name='discription2'> <br>
          <button type="submit" name="save2">upload</button>
        </form>
      </div>
    <?php
    }
    ?>

    <div class="asscontainer">
      <div>
        <div>
          <table class="sub-container">
            <thead>
              <tr>
                <th>
                  Notice Description
                </th>
                <th>
                </th>
                <th>
                  date
                </th>
              </tr>
            </thead>

            <tbody>
              <?php
              $con = mysqli_connect("localhost", "root", "", "assistu");
              $querry = mysqli_query($con, "SELECT * FROM notice");

              while ($val = mysqli_fetch_array($querry)) {
              ?>
                <tr>
                  <th><?php echo $val["notice"]; ?></th>
                  <?php if ($val['name'] != null) { ?>
                    <th><a download="<?php echo $val['name']; ?>" href="uploadscommon/<?php echo $val['name']; ?>">download</a></th>
                  <?php
                  } else {
                  ?><th></th>
                  <?php }
                  ?>
                  <th><?php echo $val["date"]; ?></th>
                </tr>
              <?php
              }
              mysqli_close($con);
              ?>


            </tbody>
          </table>
        </div>
      </div>

    </div>

  </div>



  <script>
    change = document.querySelector(".container");
    const subjecthtml = change.innerHTML;


    ba = document.querySelector("#assignments");
    ba.addEventListener('click', function() {
      change.innerHTML = document.querySelector("#assignmnetscode").innerHTML;
    })

    bs = document.querySelector("#subjects");
    bs.addEventListener('click', function() {
      change.innerHTML = subjecthtml;
    })

    bn = document.querySelector("#notices");
    bn.addEventListener('click', function() {
      change.innerHTML = document.querySelector("#noticescode").innerHTML;
    })
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>


</html>