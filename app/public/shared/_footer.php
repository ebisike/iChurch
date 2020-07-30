<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
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
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="" id="logoutx">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Profile Modal-->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hi! <b class="text-primary"><?php echo $currentuser['username']?></b></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
            </div>
            <div class="modal-body">
                Select a textbox to edit your information and click the button.
                <div class="row">
                    <div class="col-md-6">
                        <!-- firstName Edit -->
                        <label class="mb-0">first name</label>
                        <form class="inline-block form-inline pt-2" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" name="firstName"
                                placeholder="<?php echo $currentuser['firstName']?>" value="<?php echo $currentuser['firstName']?>">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" name="updateFirstName">
                                    <i class="fas fa-paper-plane fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $currentuser['Id']?>">
                            <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
                        </form>

                        <!-- lastName Edit -->
                        <label class="mb-0">last name</label>
                        <form class="inline-block form-inline pt-2" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" name="lastName"
                                placeholder="<?php echo $currentuser['lastName']?>" value="<?php echo $currentuser['lastName']?>">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" name="updateLastName">
                                    <i class="fas fa-paper-plane fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $currentuser['Id']?>">
                            <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
                        </form>
                    </div>

                    <div class="col-md-6">
                        <!-- username Edit -->
                        <label class="mb-0">username</label>
                        <form class="inline-block form-inline pt-2" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" name="username"
                                placeholder="<?php echo $currentuser['username']?>" value="<?php echo $currentuser['username']?>">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" name="updateUsername">
                                    <i class="fas fa-paper-plane fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $currentuser['Id']?>">
                            <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
                        </form>

                        <!-- password Edit -->
                        <label class="mb-0">password</label>
                        <form class="inline-block form-inline pt-2" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" name="passwords"
                                placeholder="<?php echo $currentuser['passwords']?>" value="<?php echo $currentuser['passwords']?>">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" name="updatePasswords">
                                    <i class="fas fa-paper-plane fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $currentuser['Id']?>">
                            <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
                        </form>
                    </div>
                </div>                
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../../bootstrap/vendor/jquery/jquery.min.js"></script>
<script src="../../bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../../bootstrap/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../bootstrap/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../../bootstrap/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="../../bootstrap/js/demo/chart-area-demo.js"></script>
<script src="../../bootstrap/js/demo/chart-pie-demo.js"></script>

<!-- Page level plugins -->
<script src="../../bootstrap/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../../bootstrap/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
 <script src="../../bootstrap/js/demo/datatables-demo.js"></script>
 <script src="../../bootstrap/js/mtabs-js.js"></script>

<script type="text/javaScript">
    var url = $(location).attr("href");
    var logoutbaseurl = url+'/?logout';
    document.getElementById('logoutx').setAttribute("href", logoutbaseurl);
</script>

<!-- <script>
    $(document).ready(function(){
        var roles = document.getElementById('roles');
        var users = document.getElementById('users');

        roles.addEventListener('change', users);

        function loadValues(arr, element){
            arr.forEach(item => {
                var option = document.createElement('option');
                option.value = item.id;
                option.appendChild(document.createTextNode(item.name));
                element.appendChild(option);
            })
        }

        function users(e) {
            $.ajax({
                method: "get",
                url: "/ichurch/app/web/controllers/administrationcontroller.php" + e.target.value,
                success: function (response) {
                    console.log(response);
                    loadValues(response, users);
                },
                error: function (error) {
                    console.log(error, "shit!")
                }
            })
        }

    })
</script> -->

</body>

</html>