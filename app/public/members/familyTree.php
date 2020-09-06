<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
?>

<div class="pt-1 pl-3 pr-3">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-5">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
            <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Family Tree</h1>
                    <p class="mb-4">create a new branch on the family tree, or pick an existing branch</p>
                </div>
                <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                    <label for="" class="famhide">Branch List</label>
                    <label for="" class="famshow" style="display: none">Now Creating a new Branch</label>
                    <select name="familyId" class="form-control famhide" id="users">
                    <?php
                        $results = $family->getAllTreeBranch($_SESSION['orgId']);                     
                        while ($branch = $results->getResults())
                        {
                            echo '<option value="'.$branch['familyId'].'">'.$branch['branchName'].'_'.$branch['familyId'].'</option>';
                        }
                    ?>
                    </select>  
                    <input type="checkBox" id="newFamily" class="famhide" />
                    <label for="newFamily" class="famhide">check to add a new family</label>

                    <div class="form-group">
                        <input type="text" class="form-control form-control-user famshow" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Please enter your desired family Identifier" name="branchName" style="display: none">                
                    </div>

                    <hr>
                    <button class="btn btn-primary btn-user famhide" type="submit" name="oldBranch">Go!</button>
                    <input type="submit" class="btn btn-primary btn-user btn-block famshow" name="newBranch" value="create branch" style="display: none">
                </form> <br>
                <?php
                if(isset($_POST['oldBranch']) && empty($_POST['familyId']))
                {
                    echo
                        '
                            <p class="bg-danger text-uppercase text-white p-2">kindly select a branch first from the list</p>
                        ';
                }
                ?>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>



<script>
        var show = document.querySelectorAll('.famshow');
        var hide = document.querySelectorAll('.famhide');

        document.getElementById('newFamily').addEventListener('click', displayBox);

        function displayBox(){
            for (let index = 0; index < show.length; index++) {
                show[index].style.display = 'block';
            }
            for (let index = 0; index < hide.length; index++) {
                hide[index].style.display = 'none';                
            }            
            //alert('hi');
        }
    </script>

<?php
    require ('../shared/_footer.php');
?>