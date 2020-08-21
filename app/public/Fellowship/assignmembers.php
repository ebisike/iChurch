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
                <h1 class="h4 text-gray-900 mb-2">Build Fellowship</h1>
                <p class="mb-4">add members to house cells for fellowship</p>
                </div>
                <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                    <div class="form-group">
                        <select name="fellowshipId" id="fellowship" class="form-control">
                            <option value="">Pick a Fellowship Cell</option>
                        </select>
                    </div>
                    <div class="form-group" id="">
                        <select name="memberId" id="member" class="form-control">
                            <option value="">Pick a Member</option>                            
                        </select>
                        <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
                        <input type="hidden" name="userId" value="<?php echo $_SESSION['userId']?>">
                    </div>                                                  
                    <hr>
                    <input type="submit" class="btn btn-primary btn-user btn-block" name="assign_member" value="Add">
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

        let fellowship = document.getElementById('fellowship');
        let member = document.getElementById('member');

        // cordinator.addEventListener('change', function(e){
        //     if(e.target.value != ""){
        //         document.getElementById("meetingday").style.display = "block"
        //         document.getElementById("meetingtime").style.display = "block"
        //         document.getElementById("address").style.display = "block"
        //     }else{
        //         document.getElementById("meetingday").style.display = "none"
        //         document.getElementById("meetingtime").style.display = "none"
        //         document.getElementById("address").style.display = "none"    
        //     }
        // })

        $.ajax({
            method: "GET",
            url: "ajax-housefellowship.php?fetchFellowship=<?php echo $_SESSION['orgId']?>",            
            success: function(resp){
                console.log(JSON.parse(resp))
                load(JSON.parse(resp), fellowship)
            },
            error: function(ed){
                console.log(ed);
            }
        })

        $.ajax({
            method: "GET",
            url: "ajax-housefellowship.php?fetchMember=<?php echo $_SESSION['orgId']?>",            
            success: function(resp){
                //console.log(resp)
                if(JSON.parse(resp) == "")
                {
                    alert('empty')
                }
                loadMembers(JSON.parse(resp), member)
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
                option.appendChild(document.createTextNode(arr[index].fellowshipname));
                element.appendChild(option);
            }
            console.log(element)
        }

        function loadMembers(arr, element){
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