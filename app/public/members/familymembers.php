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
            <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                <h1 class="h4 text-gray-900 mb-2">Family Tree</h1>
                <p class="mb-4">Pick a Tree Branch to view all Members</p>
                </div>
                <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                    <div class="form-group">
                        <select name="cordinatorId" id="cordinator" class="form-control searchuser">
                            <option value="">Pick a tree branch</option>
                        </select>
                    </div>                    
                </form>
            </div>
            </div>
        </div>

        <div class="row p-3">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTablex" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fullname</th>
                                <th>Gender</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Fullname</th>
                                <th>Gender</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody id="tbody">

                        </tbody>
                    </table>
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

        //$('.searchuser').select2()

        let family = document.getElementById('cordinator')
        //let tbody = document.getElementById('tbody')
        let element = document.getElementById('tbody')

        $.ajax({
            method: "GET",
            url: "ajax/gettreebranches.php?id=<?php echo $_SESSION['orgId']?>",            
            success: function(resp){
                console.log(JSON.parse(resp))

                load(JSON.parse(resp), cordinator)
            },
            error: function(ed){
                console.log(ed);
            }
        })
        //console.log(element)

        family.addEventListener('change', function(e){
            //console.log(e.target.value)
            $.ajax({
                method: "GET",
                url: `ajax/getmembers.php?familyId=${e.target.value}&orgId=<?php echo $_SESSION['orgId']?>`,
                success: function(respp){
                    let resps = JSON.parse(respp)
                    console.log(resps)
                    loadTableView(resps, element)
                },
                error: function(err){
                    console.log(err)
                }
            })
        })
        function load(arr, element){
            //console.log(typeof arr)
            for (let index = 0; index < arr.length; index++) {
                var option = document.createElement('option');
                option.value = arr[index].familyId;
                option.appendChild(document.createTextNode(arr[index].familyId + '_' + arr[index].branchName));
                element.appendChild(option);
            }
        }

        function loadTableView(arr, element)
        {
            element.textContent = ""
            let i = 0
            for (let index = 0; index < arr.length; index++) {
            
                const tRow = document.createElement('tr')
                const tData1 = document.createElement('td')
                const tData2 = document.createElement('td')
                const tData3 = document.createElement('td')
                let link = document.createElement('a')

                link.setAttribute("href", '../members/view.php?find='+arr[index].Id)
                link.appendChild(document.createTextNode(arr[index].lastName + ' ' + arr[index].otherName + ' ' + arr[index].firstName))
                tData1.appendChild(document.createTextNode(++i))
                tData2.appendChild(link)
                tData3.appendChild(document.createTextNode(arr[index].gender))

                tRow.appendChild(tData1)
                tRow.appendChild(tData2)
                tRow.appendChild(tData3)

                element.appendChild(tRow)
                
            }
        }
    })
</script>