<?php include "header.php"; 
if ($role!=0) {
  header("location:../404.php");
}
$user = $_SESSION['u_data'] ?? [];

?>

<div class="container mt-5 mb-2">
  <div class="row m-2">
    <div class="col-md-7 m-auto emp_profile p-4 border border-secondary">
      <p class="text-center bg-white p-3">
        
        <span class="emp_name">
          <?php echo $user['name'] ?? 'Admin'; ?>
        </span>
        
        <br>
        
        <span>
          (<?php echo $user['designation'] ?? 'Computer Programmer'; ?>
        </span>
        
        <span> 
          <?php echo $user['scale'] ?? 'BPS-17'; ?>)
        </span>
      
      </p>

      <div class="bg-white p-3">
        <?php
        if (isset($_SESSION['error'])) {
        $msg = $_SESSION['error'];
        echo $msg;
        unset($_SESSION['error']);
        }
         ?>
        <form action="report.php" method="POST">
          <label><strong>Daily Work</strong></label>
          <input type="date" name="work_date" class="form-control" required>
          <button name="report_btn" class="btn btn-primary mt-2">Report Generate</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>