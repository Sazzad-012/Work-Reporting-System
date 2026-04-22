<?php include "header.php"; 
if ($role!=1) {
  header("location:../404.php");
}
$user = $_SESSION['u_data'] ?? [];

?>
<div class="container mt-2 mb-2">
  <div class="row">
    <div class="col-md-6 m-auto emp_profile p-4 border border-secondary">
      <p class="text-center bg-white p-3"> <span class="emp_name"><?php echo $user['name'] ?? 'Md. Sazzad rashid Chowdhury'; ?></span>
        <br> <span>(<?php echo $user['designation'] ?? 'Web Developer'; ?></span> <span><?php echo $user['scale'] ?? 'BPS-16'; ?>)</span> </p>
      <div class="bg-white p-3"> <strong>Job Responsibilities</strong>
        <ul>
          <li><small><?php echo $user['res'] ?? 'Build and maintain websites and web applications. Ensure responsive and user-friendly design. Write clean and efficient code. Fix bugs and improve performance. Manage databases and ensure security.'; ?></small></li>
        </ul>
      </div>
      <br>
      <div class="bg-white p-3">
        <form method="POST">
          <?php
          if (isset($_SESSION['msg'])) {
            $msg=$_SESSION['msg'];
            echo "<p>$msg</p>";
            unset($_SESSION['msg']);
          }
          ?>
          <label><strong>Daily Work</strong></label>
          <textarea required="required" class="form-control" rows="5" name="work_desc" maxlength="200" minlength="10"></textarea>
          <button name="work_btn" class="btn btn-primary mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; 
if (isset($_POST['work_btn'])) {
  $id = $user['id']; 
  $work_desc = mysqli_real_escape_string($con, $_POST['work_desc']);
  $date = date('Y-m-d'); // better format for DB

  $check = "SELECT * FROM work_tbl 
            WHERE employee_id='$id' AND work_date='$date'";
  $query = mysqli_query($con, $check);
  $rows  = mysqli_num_rows($query);

  if ($rows > 0) {
    $_SESSION['msg'] = "<small class='text-danger'>You can't submit work again on the same date</small>";
    header("location:emp_profile.php");
    exit();
  } else {
    $insert = "INSERT INTO work_tbl (employee_id,work_desc,work_date) 
               VALUES('$id','$work_desc','$date')";
    $query = mysqli_query($con, $insert);

    if ($query) {
      $_SESSION['msg'] = "<small class='text-success'>Work submitted successfully</small>";
      header("location:emp_profile.php");
      exit();
    }
  }
}
?>