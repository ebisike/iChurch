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

<!-- SUBSCRIPTIONS CATEGORY -->
<div class="modal fade" id="subscriptionCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-lg-center text-uppercase p-3" style="margin: auto auto;">Subscription categories!</h3>                
            </div>
            <div class="modal-body text-dark text-center">
                <div>
                    <h5>Account Info!</h5>
                    <p>Account Name: GEORGE CHIGOZIE EBISIKE</p>
                    <p>Account Number: 0036231862</p>
                </div>
                <div class="row" style="margin: auto auto;" id="category">
                <?php
                    foreach ($packagelist as $value)
                    {
                        if($value['duration'] == 0 && $history != null){
                            continue; //skip free pack
                        }
                        echo
                        '
                            <div class="col-md-4 p-5 m-3 bg-white shadow-lg text-center">
                                <h4 class="mt-5 ml-5 mr-5 mb-3 text-uppercase">'.$value['packagename'].'</h4>
                                <h1 class="p-0 text-uppercase font-weight-bold">₦'.$value['cost'].'.00k</h1>
                                <h4 class="p-2" style="border-top: 1px solid black; width:50%; margin: auto auto">'.setPackageDurationDisplayName($value['duration']).'</h4>
                                <hr class="bg-success">
                                <p class="text-capitalize">'.$orgname.'</p>
                                <p>'.$orgemail.'</p>
                                <div class="subscribe">
                                    <h3 id="subscribe" class="m-5 p-3 bg-success text-white">Subscribe</h3>
                                    <input type="hidden" value="" id="'.$value['Id'].'" name="pkgId"/>
                                    <input type="hidden" value="" id="'.$_SESSION['orgId'].'" name="orgId"/>
                                </div>
                            </div>
                        ';
                    }
                ?>            
                </div>
            </div>
            <div class="modal-footer">
                    <a href="" id="logouty">Take me Home</a>
            </div>
        </div>
    </div>
</div>

<!-- SUBSCRIPTIONS SUCCESSFUL -->
<div class="modal fade" id="subscriptionSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-lg-center text-uppercase p-3" style="margin: auto auto;">Subscription Notice!</h3>                
            </div>
            <div class="modal-body text-dark text-center">
                <P>Hi!.</P>
                <p>
                    Your Request has been recived, and is awaiting approval. <br>
                    please check back later to see if it has been proccessed; as a representative has been assigned to ensure that you're connected back to our service.
                </p>
                <p>
                    For more info, contact us via our email address: <a href="mailto: georgefx.creativecompany@gmail.com">georgefx.creativecompany@gmail.com</a> <br>
                    Thanks for your patronage.
                </p>
            </div>
            <div class="modal-footer">
                <p>powered  by: GEORGEfx. <span><a href="../mgt/index.php">Take me Home</a></span></p>
            </div>
        </div>
    </div>
</div>

<!-- Account Expired Modal-->
<div class="modal fade" id="expired" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-lg-center" id="exampleModalLabel">ACCOUNT NOTICE!</h5>                
            </div>
            <div class="modal-body text-dark text-center">
                    <?php 
                        if($userRoleSuperAdmin || $userRoleLeadPastor || $userRoleSecretary)
                        {
                            echo 
                            '
                                <p>
                                    Hi! <span class="font-weight-bold">'.$orgname.'</span> your subscription has expired.<br>
                                    Please Contact the <a href="../Subscriptions/category.php">System Administror</a> for more details
                                </p>
                            ';
                        }
                        else{
                            echo 'Hi! <span class="font-weight-bold">'.$orgname.'</span> <br> Sorry. Subscription has Expired. Please report to your supiror for further actions.';
                        }
                    ?>
            </div>
            <div class="modal-footer">               
                <?php 
                    if(!$userRoleSuperAdmin || !$userRoleLeadPastor || !$userRoleSecretary)
                    {
                        echo '<a class="btn btn-danger disabled" href="#" id="leave">Opps!</a>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Details of Account Statement-->
<div class="modal fade" id="accountStatementDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-lg-center font-weight-bold text-primary" id="sourceTitle"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
            </div>
            <div class="modal-body text-dark">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Narration</th>
                                <th>Amount</th>
                                <th>Value Date</th>
                                <th>posted by</th>
                            </tr>
                        </thead>
                        <tbody id="detailsView"></tbody>
                    </table>
                    <div id="summary"></div>
                </div>
            </div>
            <div class="modal-footer">               
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Attendance Register-->
<div class="modal fade" id="attendanceRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-lg-center font-weight-bold text-primary" id="attendanceTitle"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
            </div>
            <div class="modal-body text-dark">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Males</th>
                                <th>Females</th>
                                <th>Children</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="attendancetable"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">               
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Post Attendance -->
<div class="modal fade" id="postAttendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-lg-center font-weight-bold text-primary">Create a New Attendance Record</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
            </div>
            <div class="modal-body text-dark">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" class="user">
                    <input type="hidden" name="orgId" value="<?php echo  $_SESSION['orgId']?>">
                    <input type="hidden" name="userId" value="<?php echo  $_SESSION['userId']?>">
                    <div class="form-group">
                        <input type="number" name="males" class="form-control form-control-user" min="0" placeholder="Enter total number of males">
                    </div>
                    <div class="form-group">
                        <input type="number" name="females" class="form-control form-control-user" min="0" placeholder="Enter total number of females">
                    </div>
                    <div class="form-group">
                        <input type="number" name="children" class="form-control form-control-user" min="0" placeholder="Enter total number of Children">
                    </div>
                    <div class="form-group">
                        <label for="">Pick Attendance date</label>
                        <input type="date" name="dates" class="form-control form-control-user datefield" placeholder="Enter total number of Children">
                    </div>
                    <input type="submit" value="Add" name="postAttendance" class="btn btn-primary">
                </form>
            </div>
            <div class="modal-footer">               
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
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
                <form class="pt-2 user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
                    <!-- firstName Edit -->
                    <div class="form-group">
                        <label class="">first name</label>
                        <input type="text" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Update your first name" name="firstName" value="<?php echo $currentuser['firstName']?>">
                        <input type="hidden" name="id" value="<?php echo $currentuser['Id']?>">
                        <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
                    </div>
                    <div class="form-group">
                        <label for="">Last Name</label>
                        <input type="text" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Update your Last Name" name="lastName" value="<?php echo $currentuser['lastName']?>">                
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control form-control-user" id="username" aria-describedby="emailHelp" placeholder="Enter a new Username" name="username" value="<?php echo $currentuser['username']?>">                
                    </div>                
                    <div class="form-group">
                        <label>upload an Image</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                    <hr>
                    <!-- <button class="btn btn-primary shadow" type="submit" name="updateUser">
                        <i class="fas fa-paper-plane fa-sm"></i>
                    </button> -->
                    <input type="submit" class="btn btn-primary btn-user btn-block" name="updateUserProfile" value="update user">

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Report Modal-->
<div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Generate Account Statement?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
            </div>
            <div class="modal-body">
                Select Start and End date to generate report.
                <form class="user mt-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                    <div class="form-group row">
                        <label class="col-md-4">Start Date</label>
                        <div class="col-md-8">
                            <input type="date" name="startdate" class="form-control form-control-user datefield" placeholder="Enter Start Date" id="startDate">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">End Date</label>
                        <div class="col-md-8">
                            <input type="date" name="enddate" class="form-control form-control-user datefield" placeholder="Enter End Date" id="endDate" disabled="true">
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $_SESSION['orgId']?>" name="orgId" />
                    <input type="submit" class="btn btn-primary float-lg-left offset-4" name="report" value="generate">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Quick Search Birthday-->
<div class="modal fade" id="quickSearchBirthday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Search for a range of birthdays?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                    <div class="form-group row">
                        <label class="col-md-4 text-dark font-weight-bold">Start Date</label>
                        <div class="col-md-8">
                            <input type="date" name="startdate" class="form-control form-control-user" placeholder="Enter Start Date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 text-dark font-weight-bold">End Date</label>
                        <div class="col-md-8">
                            <input type="date" name="enddate" class="form-control form-control-user" placeholder="Enter End Date">
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $_SESSION['orgId']?>" name="orgId" />
                    <button type="submit" class="btn btn-primary float-lg-left offset-4" name="searchBirthday"> <i class="fas fa-search"></i> SEARCH</button>
                    <!-- <input type="submit" class="btn btn-primary float-lg-left offset-4" name="report" value="generate"> -->
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Quick Search Anniversary-->
<div class="modal fade" id="quickSearchAnniversary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Search for a range of wedding Anniversaries?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                    <div class="form-group row">
                        <label class="col-md-4 text-dark font-weight-bold">Start Date</label>
                        <div class="col-md-8">
                            <input type="date" name="startdate" class="form-control form-control-user" placeholder="Enter Start Date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 text-dark font-weight-bold">End Date</label>
                        <div class="col-md-8">
                            <input type="date" name="enddate" class="form-control form-control-user" placeholder="Enter End Date">
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $_SESSION['orgId']?>" name="orgId" />
                    <button type="submit" class="btn btn-primary float-lg-left offset-4" name="searchAnniversary"> <i class="fas fa-search"></i> SEARCH</button>
                    <!-- <input type="submit" class="btn btn-primary float-lg-left offset-4" name="report" value="generate"> -->
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Quick Search Family Tree-->
<div class="modal fade" id="familyTree" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search for a range of wedding Anniversaries?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                    <div class="form-group row">
                        <label class="col-md-4 text-dark font-weight-bold">Family Id</label>
                        <div class="col-md-8">
                            <input type="text" name="familyId" class="form-control form-control-user" placeholder="Enter a Family Id">
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $_SESSION['orgId']?>" name="orgId" />
                    <button type="submit" class="btn btn-primary float-lg-left offset-4" name="searchFamily"> <i class="fas fa-search"></i> SEARCH</button>
                    <!-- <input type="submit" class="btn btn-primary float-lg-left offset-4" name="report" value="generate"> -->
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Calendar Popup-->
<div class="modal fade" id="calendarPopUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Search Result for Calendar Event</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="calendarDetails">
                <h3 class="text-uppercase text-primary text-center" id="title"></h3>
                <p class="text-center" id="des"></p>
                <p class="text-center" id="org"> Organised By: </p>
                <p class="text-center" id="calDate"></p>
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

<script src="../../bootstrap/vendor/select2/select2.min.js"></script>


<!-- Page level custom scripts -->
 <script src="../../bootstrap/js/demo/datatables-demo.js"></script>
 <script src="../../bootstrap/js/mtabs-js.js"></script>
 <script src="../../bootstrap/js/custom/logout-url.js"></script>
 <!-- set max date for input fields -->
 <script src="../../bootstrap/js/custom/max-date.js"></script>
 <script src="../../bootstrap/vendor/jquery/jQuery.print.js"></script>

<script type="text/javaScript">
    //document.getElementById('callbackurl').setAttribute("value", url);
</script>

<!-- Canvasjs Charts Plugin -->
<script src="../../bootstrap/vendor/chart.js/canvasjs.min.js"></script>


<script>
    $(document).ready(function() {
        $.ajax({
            method: "GET",
            url: "../ajax/verifier.php?orgId=<?php echo  $_SESSION['orgId']?>",
            success: function(resp) {
                var resp = JSON.parse(resp)
                let expiryDate = resp.expirydate
                //console.log('today is: '+today)
                // console.log('expired is: '+ expiryDate)
                var url = $(location).attr("href");
                let currentURL = 'http://127.0.0.1/ichurch/app/public/Subscriptions/category.php';
                if(url == currentURL){
                    //do nothing
                    //let the category page handle the request
                }
                else
                {
                    if (expiryDate <= today) {
                        $('#expired').modal({
                            backdrop: 'static',
                            keyboard: false,
                        })
                        $('#expired').modal('show')
                        document.getElementById('leave').addEventListener('click', function(){
                            let url = $(location).attr("href");
                            window.location.replace(url+'?logout')
                        })
                    }
                }            
            },
            error: function(err) {
                alert('error')
                console.log("error")
            }
        });
})
</script>

</body>

</html>