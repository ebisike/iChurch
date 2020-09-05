<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
    //include '../../web/controllers/usermanagement.php';
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
                <h1 class="h4 text-gray-900 mb-2">Create a New User</h1>
                <p class="mb-4">create users for your organisation</p>
                </div>
                <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>upload an Image</label>
                        <input type="file" name="file" class="form-control" value="1.jpg">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter First Name..." name="firstName">
                        <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Last Name..." name="lastName">                
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="username" aria-describedby="emailHelp" placeholder="Enter username..." name="username" >
                        <span class="text-danger" id="username-error"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user disabled" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Default password is: 12345" name="passwords" value="12345" readonly>
                        <p class="small p-1">Default password is: 12345</p>
                    </div>
                    <hr>
                    <input type="submit" class="btn btn-primary btn-user btn-block" name="create" value="create user">
                </form>
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
        let usernameInput = document.getElementById('username')

        //get a list of all users.
        $.ajax({
                method: "GET",
                url: "validate.php?orgId=<?php echo $_SESSION['orgId']?>",
                success: function(resp){
                    document.querySelector('#username').addEventListener('blur', validateInput(JSON.parse(resp)))
                    //console.log(JSON.parse(resp));
                },
                error: function(error){
                    console.log(error);
                }

            })        
        
        function validateInput(data){
            console.log(data[1].username)

            let userinput = data.filter(d => d.username.toLowerCase() === usernameInput.value.toLowerCase())
            console.log(userinput)
            if(userinput[0].username)
            {
                document.getElementById('username-error').textContent = "username is already taken"
            }
        }
    })
</script>