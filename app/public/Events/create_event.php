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
                <h1 class="h4 text-gray-900 mb-2">Create a New Event</h1>
                <p class="mb-4">create events that the church has organised</p>
                </div>
                <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">                    
                    <div class="form-group">
                        <input type="text" class="form-control-user form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Event Name..." name="eventname">
                        <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
                        <input type="hidden" name="userId" value="<?php echo $_SESSION['userId']?>">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control-user form-control" id="datefield" aria-describedby="emailHelp" placeholder="Enter Date Hosted..." name="eventdate">                
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control-user form-control" id="" aria-describedby="emailHelp" placeholder="Enter Numbver of people that attended..." name="numberofguests" >                
                    </div>                    
                    <hr>
                    <input type="submit" class="btn btn-primary btn-user btn-block" name="add_event" value="Create Event">
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