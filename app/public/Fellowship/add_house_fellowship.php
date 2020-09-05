<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');

    include '../../Web/Controllers/house-fellowship.php';
?>

<div class="mt-0 ml-5 mr-5">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
            <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                <h1 class="h4 text-gray-900 mb-2">Create a New House Fellowship</h1>
                <p class="mb-4">add house cells for fellowship</p>
                </div>
                <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                    <div class="form-group">
                        <select name="cordinatorId" id="cordinator" class="form-control">
                            <option value="">Pick a Co-ordinator for the Fellowship Cell</option>
                        </select>
                    </div>
                    <div class="form-group" id="name">
                        <input type="text" class="form-control-user form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Fellowship Name..." name="fellowshipname">                        
                    </div>
                    <div class="form-group" id="meetingday">
                        <select name="meetingday" id="cordinator" class="form-control">
                            <option value="">Pick a Meeting Day</option>
                            <option value="Sunday">Sunday</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                        </select>
                        <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
                        <input type="hidden" name="userId" value="<?php echo $_SESSION['userId']?>">
                    </div>
                    <div class="form-group" id="meetingtime">
                        <input type="time" class="form-control-user form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Middle Name..." name="meetingtime">                        
                    </div>
                    <div class="form-group" id="address">
                        <input type="text" class="form-control-user form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Address..." name="addresss">                        
                    </div>
                    <hr>
                    <input type="submit" class="btn btn-primary btn-user btn-block" name="add_house_fellowship" value="Add">
                </form><a href="house-fellowships.php">back to list</a>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>

<?php
    require ('../shared/_footer.php');
?>

<script>
    $(document).ready(function(){

        document.getElementById("meetingday").style.display = "none"
        document.getElementById("meetingtime").style.display = "none"
        document.getElementById("address").style.display = "none"
        document.getElementById("name").style.display = "none"

        let cordinator = document.getElementById('cordinator');

        cordinator.addEventListener('change', function(e){
            if(e.target.value != ""){
                document.getElementById("meetingday").style.display = "block"
                document.getElementById("meetingtime").style.display = "block"
                document.getElementById("address").style.display = "block"
                document.getElementById("name").style.display = "block"
            }else{
                document.getElementById("meetingday").style.display = "none"
                document.getElementById("meetingtime").style.display = "none"
                document.getElementById("address").style.display = "none"
                document.getElementById("name").style.display = "none"
            }
        })

        $.ajax({
            method: "GET",
            url: "ajax/add_fellowship.php?id=<?php echo $_SESSION['orgId']?>",            
            success: function(resp){
                console.log(resp)

                load(JSON.parse(resp), cordinator)
            },
            error: function(ed){
                console.log(ed);
            }
        })
        function load(arr, element){
            //console.log(typeof arr)
            for (let index = 0; index < arr.length; index++) {
                var option = document.createElement('option');
                option.value = arr[index].Id;
                option.appendChild(document.createTextNode(arr[index].firstName + ' ' + arr[index].otherName + ' ' + arr[index].lastName));
                element.appendChild(option);
            }
        }
    })
</script>