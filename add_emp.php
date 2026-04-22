<?php 
include "header.php";

if (isset($_POST['add_emp'])) {

  $fullname = mysqli_real_escape_string($con, $_POST['user_name']);
  $des = mysqli_real_escape_string($con, $_POST['user_des']);
  $res = mysqli_real_escape_string($con, $_POST['user_res']);
  $scale = mysqli_real_escape_string($con, $_POST['user_scale']);
  $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
  $role = mysqli_real_escape_string($con, $_POST['user_role']);

  
  if ($user_id == 'user_id' || empty($user_id)) {
    $_SESSION['error'] = "Please enter a valid User ID";
    header("location:add_emp.php");
    exit();
  }

  
  if (strlen($_POST['user_pass']) < 4) {
    $_SESSION['error'] = "Password must have minimum 4 characters";
    header("location:add_emp.php");
    exit();
  }

  
  $pass = mysqli_real_escape_string($con, sha1($_POST['user_pass']));

  
  $sql = "SELECT * FROM user_tbl WHERE user_id='$user_id'";
  $query = mysqli_query($con, $sql);

  if (mysqli_num_rows($query) > 0) {
    $_SESSION['error'] = "<small class='text-danger'>User ID already exists</small>";
    header("location:add_emp.php");
    exit();
  } else {

    // Insert data
    $sql = "INSERT INTO user_tbl(fullname,user_des,user_scale,user_res,user_id,user_pass,user_role) 
            VALUES('$fullname','$des','$scale','$res','$user_id','$pass','$role')";

    if (mysqli_query($con, $sql)) {
      $_SESSION['success'] = "<small>Data Inserted Successfully</small>";
      header("location:add_emp.php");
      exit();
    }
  }
}
?>

<div class="container mt-2">
  <form action="" method="POST">
    <div class="row m-2 p-3 register_form border border-secondary">

      <?php
      if (isset($_SESSION['error'])) {
        echo $_SESSION['error'];
        unset($_SESSION['error']);
      }

      if (isset($_SESSION['success'])) {
        echo $_SESSION['success'];
        unset($_SESSION['success']);
      }
      ?>

      <h5 class="text-center">Employee Registration Form</h5>

      <div class="col-md-5 m-auto">
        <div class="mb-2">
          <label>Fullname</label>
          <input type="text" name="user_name" class="form-control" required maxlength="30" minlength="3">
        </div>

        <div class="mb-2">
          <label>Designation</label>
          <input type="text" name="user_des" class="form-control" required maxlength="30" minlength="3">
        </div>

        <div class="mb-2">
          <label>Responsibilities</label>
          <textarea class="form-control" rows="6" name="user_res" maxlength="300" minlength="10"></textarea>
        </div>
      </div>

      <div class="col-md-5 m-auto">
        <div class="mb-2">
          <label>Scale</label>
          <select class="form-control" name="user_scale" required>
            <option value="">Select Scale</option>
            <option value="BPS-09">BPS-09</option>
            <option value="BPS-10">BPS-10</option>
            <option value="BPS-11">BPS-11</option>
            <option value="BPS-12">BPS-12</option>
            <option value="BPS-13">BPS-13</option>
            <option value="BPS-14">BPS-14</option>
            <option value="BPS-15">BPS-15</option>
            <option value="BPS-16">BPS-16</option>
            <option value="BPS-17">BPS-17</option>
            <option value="BPS-18">BPS-18</option>
            <option value="BPS-19">BPS-19</option>
            <option value="BPS-20">BPS-20</option>
          </select>
        </div>

        <div class="mb-2">
          <label>User ID</label>
          <input type="text" name="user_id" class="form-control" required maxlength="30" minlength="4">
        </div>

        <div class="mb-2">
          <label>Password</label>
          <input type="password" name="user_pass" class="form-control" required minlength="4">
        </div>

        <div class="mb-2">
          <label>User Role</label>
          <select name="user_role" class="form-control" required>
            <option value="">Select Role</option>
            <option value="1">Normal User</option>
            <option value="0">Admin</option>
          </select>
        </div>

        <div class="mb-2">
          <button class="btn btn-primary" name="add_emp">Register</button>
          <a href="users_list.php" class="btn btn-secondary">Back</a>
        </div>
      </div>

    </div>
  </form>
</div>

<?php include "footer.php"; ?>