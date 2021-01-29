<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');

    $houseFellowship = new HouseFellowship();
    
    if(isset($_GET['del']))
    {
        $phone = $_GET['del'];
        $houseFellowship->deleteFellowshipUnit($Id, $_SESSION['orgId']);
    }

    if(isset($_GET['retain']))
    {
        $phone = $_GET['retain'];
        $firstTimer->retainFirstTimer($phone, $_SESSION['orgId']);
    }
?>

<?php
    if(!$userRoleRegular)
    {
        echo 
        '
            <div class="p-3">
                <a href="add_house_fellowship.php" class="btn btn-primary p-1 font-weight-bold"> <i
                        class="fa fa-plus fa-1x bg-primary p-1 text-white"></i> Add House Fellowship</a>
                <a href="assignmembers.php" class="btn btn-info p-1 font-weight-bold"> <i
                        class="fa fa-plus fa-1x bg-info p-1 text-white"></i> Add Members to House Fellowship</a>
            </div>
        ';
    }
?>


<!-- DataTales Example -->
<div class="pt-0 pl-3 pr-3">
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All House Fellowships</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <form action="" class="user pb-5">
                        <label for="" class="text-dark">Pick a Fellowship Unit from the List</label>
                        <select name="" id="fellowship" class="form-control">
                            <option value="" class="form-control">Pick a Fellowship Unit</option>
                        </select>
                    </form>
                </div>
                <div class="col-md-12" id="fellowship-info">
                    <h4 class="text-dark bg-info font-weight-bold p-2">Fellowship Info: <span class="text-white" id="fellowshipname"></span></h4>
                    <p class="font-weight-bold text-uppercase">Co-ordinator: <a id="link"><span id="cordinator"></span></a></p>
                    <p class="font-weight-bold">Meeting Day: <span id="meetingDay"></span></p>
                    <p class="font-weight-bold">Meeting Venue: <span id="meetingVenue"></span></p>
                    <p class="font-weight-bold">Meeting Time: <span id="meetingTime"></span></p>
                </div>
            </div>
            <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTablex" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Member FullName</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Member FullName</th>
                        <th>Phone Number</th>
                    </tr>
                </tfoot>
                <tbody class="text-dark" id="tbody">
                                
                </tbody>
            </table>
            </div>
        </div>
        </div>
</div>
<?php
    require ('../shared/_footer.php');
?>

<script>
    $(document).ready(function(){
        let fellowship = document.getElementById('fellowship')
        let tableBody = document.getElementById('tbody')
        let cordinator = document.getElementById('cordinator')
        let meetingDay = document.getElementById('meetingDay')
        let meetingVenue = document.getElementById('meetingVenue')
        let meetingTime = document.getElementById('meetingTime')
        let fellowshipName = document.getElementById('fellowshipname')
        //console.log(tableBody)

        //hide the fellowship info on load
        document.getElementById('fellowship-info').style.display = 'none'

        fellowship.addEventListener('change', function(){
            document.getElementById('fellowship-info').style.display = 'block'
        })
        
        $.ajax({
            method: "GET",
            url: "ajax/view_fellowship.php?fellowshipList=<?php echo $_SESSION['orgId']?>",
            success: function(resp){
                //console.log(JSON.parse(resp))
                loadSelectList(JSON.parse(resp), fellowship)
            },
        })

        fellowship.addEventListener('change', fillTable)
        function fillTable(e)
        {
            $.ajax({
            method: "GET",
            url: "ajax/view_fellowship.php?fellowshipID="+e.target.value+"&orgId=<?php echo $_SESSION['orgId']?>",
            success:function(resp){
                    //console.log(tableBody)
                    loadTable(JSON.parse(resp), tableBody)
                    //load the fellowship cordinator details
                    $.ajax({
                            method: "GET",
                            url: "ajax/view_fellowship.php?fetchCordinator="+e.target.value+"&orgId=<?php echo $_SESSION['orgId']?>",
                            success: function(resp){
                                let obj = JSON.parse(resp)
                                let link = document.getElementById('link')
                                link.setAttribute("href", '../members/view.php?find='+obj.Id)
                                cordinator.appendChild(document.createTextNode(obj.firstName + ' ' + obj.otherName + ' ' + obj.lastName))
                                meetingDay.appendChild(document.createTextNode(obj.meetingday))
                                meetingVenue.appendChild(document.createTextNode(obj.addresss))
                                meetingTime.appendChild(document.createTextNode(obj.meetingtime))
                                fellowshipName.appendChild(document.createTextNode(obj.fellowshipname))
                            }
                    })
                }
            })
        }    

        function loadSelectList(arr, DOMelement)
        {
            DOMelement.textContent = ""
            for (let index = 0; index < arr.length; index++)
            {
                var option = document.createElement('option');
                option.value = arr[index].Id;
                option.setAttribute("id", arr[index].Id)
                option.appendChild(document.createTextNode(arr[index].fellowshipname));
                DOMelement.appendChild(option);
            }
        }
        function loadTable(arr, DOMelement)
        {
            DOMelement.textContent = ""
            let i=0
            for (let index = 0; index < arr.length; index++)
            {
                var tRow = document.createElement('tr');
                
                var tData1 = document.createElement("td");
                var tData2 = document.createElement("td");
                var tData3 = document.createElement('td');
                let link = document.createElement("a");

                tData1.appendChild(document.createTextNode(++i))
                link.setAttribute("href", '../members/view.php?find='+arr[index].Id)
                link.appendChild(document.createTextNode(arr[index].firstName + ' ' + arr[index].otherName + ' ' + arr[index].lastName))
                tData2.appendChild(link)
                tData3.appendChild(document.createTextNode(arr[index].phone1))
                tRow.appendChild(tData1)
                tRow.appendChild(tData2)
                tRow.appendChild(tData3)
                 
                DOMelement.appendChild(tRow);
            }
        }
    })
</script>