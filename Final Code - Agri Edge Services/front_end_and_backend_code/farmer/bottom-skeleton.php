 <?php
    
  $result->close();
  $conn->close();

 ?>
 <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Agri Edge 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
	<div class="modal-footer">
	<form method="post" action="">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input class="btn btn-primary" id="logout" name="logout" type="submit" value="Logout">
	</form>
	<?php 
  		if(isset($_POST['logout'])){
			echo "inside logout";
                       //session_start();
                       $_SESSION["isLogged"] = "0";
		       //session_destroy();
			echo "<script>window.location='../index.php'</script>";
              }
          ?>
        </div>
      </div>
    </div>
  </div>
