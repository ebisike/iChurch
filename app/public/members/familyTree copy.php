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
                <p>In this example, we use JavaScript to "click" on the London button, to open the tab on page load.</p>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">London</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Paris</button>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button>
</div>

<div id="London" class="tabcontent">
  <h3>London</h3>
  <p>London is the capital city of England.</p>
</div>

<div id="Paris" class="tabcontent">
  <h3>Paris</h3>
  <p>Paris is the capital of France.</p> 
</div>

<div id="Tokyo" class="tabcontent">
  <h3>Tokyo</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>

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