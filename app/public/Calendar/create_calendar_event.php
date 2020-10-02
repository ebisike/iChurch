<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');

    include '../../Web/Controllers/events-handler.php';
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
                <h1 class="h4 text-gray-900 mb-2">Create a New Calendar Event</h1>
                <p class="mb-4">create events that the church has organised</p>
                </div>
                <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">                    
                    <div class="form-group">
                        <input type="text" class="form-control-user form-control" aria-describedby="emailHelp" placeholder="Enter Event Name..." name="Title">
                        <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
                        <input type="hidden" name="userId" value="<?php echo $_SESSION['userId']?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control-user form-control" aria-describedby="emailHelp" placeholder="Enter Short Description" name="descriptions">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control-user form-control" aria-describedby="emailHelp" placeholder="Enter Primary Organizers" name="organizer">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control-user form-control" id="calendarDate" aria-describedby="emailHelp" placeholder="Enter Date Hosted..." name="EventDate">                
                    </div>                   
                    <hr>
                    <input type="submit" class="btn btn-primary btn-user btn-block" disabled id="submit" name="addCalendarEvent" value="Create Event"><span><small id="hider" class="font-weight-bold text-danger">Please select a date to submit</small></span>
                </form><a href="calendar.php">back to list</a>
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
    $(document).ready(function (){
        let submit = document.getElementById('submit')
        let hider = document.getElementById('hider')

        document.getElementById('calendarDate').addEventListener('change', function(e){

            let calendarDate = $('#calendarDate').val()
            //console.log('date is: '+calendarDate)
            $.ajax({
                method: "GET",
                url: `ajax/calendarselector.php?select=${calendarDate}`,
                success: function(resp){
                    let obj = JSON.parse(resp)
                    console.log(obj)
                    if(obj.length > 0){
                        hider.innerHTML = "DATE BOOKED!: Sorry The Date is unavailable"
                    }else{
                        hider.innerHTML = "DATE FREE! your selected date is available and free. click the submit button to add to schedule"
                        submit.removeAttribute("disabled")
                    }
                },
                error: function(resp){
                    console.log(JSON.parse(resp))
                }
            })
        })
    })
</script>