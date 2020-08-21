<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');

    include '../../Web/Controllers/first-timers-handler.php';
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
                <h1 class="h4 text-gray-900 mb-2">Create a First Timer</h1>
                <p class="mb-4">add first timers to church DB for followup</p>
                </div>
                <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                    <div class="form-group">
                        <select name="eventId" id="event" class="form-control">
                            <option value="">Pick an Event from the List</option>
                        </select>
                    </div>
                    <div class="form-group" id="first-timer-name1">
                        <input type="text" class="form-control-user form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter First Name..." name="firstname">
                        <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
                        <input type="hidden" name="userId" value="<?php echo $_SESSION['userId']?>">
                    </div>
                    <div class="form-group" id="first-timer-name2">
                        <input type="text" class="form-control-user form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Middle Name..." name="othername">                        
                    </div>
                    <div class="form-group" id="first-timer-name3">
                        <input type="text" class="form-control-user form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Last Name..." name="lastname">                        
                    </div>
                    <div class="form-group" id="phone">
                        <input type="text" class="form-control-user form-control" id="datefield" aria-describedby="emailHelp" placeholder="Enter Phone number..." name="phone">                
                    </div>
                    <div class="form-group" id="address">
                        <input type="text" class="form-control-user form-control" id="" aria-describedby="emailHelp" placeholder="Enter Address..." name="addresss" >                
                    </div>                    
                    <hr>
                    <input type="submit" class="btn btn-primary btn-user btn-block" name="add_first_timer" value="Add">
                </form><a href="allevents.php">back to list</a>
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

        document.getElementById("first-timer-name1").style.display = "none"
        document.getElementById("first-timer-name2").style.display = "none"
        document.getElementById("first-timer-name3").style.display = "none"
        document.getElementById("phone").style.display = "none"
        document.getElementById("address").style.display = "none"

        let event = document.getElementById('event');

        event.addEventListener('change', function(e){
            if(e.target.value != ""){
                document.getElementById("first-timer-name1").style.display = "block"
                document.getElementById("first-timer-name2").style.display = "block"
                document.getElementById("first-timer-name3").style.display = "block"
                document.getElementById("phone").style.display = "block"
                document.getElementById("address").style.display = "block"
            }else{
                document.getElementById("first-timer-name1").style.display = "none"
                document.getElementById("first-timer-name2").style.display = "none"
                document.getElementById("first-timer-name3").style.display = "none"
                document.getElementById("phone").style.display = "none"
                document.getElementById("address").style.display = "none"
            }
        })

        $.ajax({
            method: "GET",
            url: "first-timers.php?id=<?php echo $_SESSION['orgId']?>",            
            success: function(resp){
                console.log(resp)

                load(JSON.parse(resp), event)
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
                option.appendChild(document.createTextNode(arr[index].eventname));
                element.appendChild(option);
            }
        }
    })
</script>