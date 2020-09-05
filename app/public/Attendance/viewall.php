<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
    $org = new Organisations();
    $attendance = new Attendance();
    $validate = new InputValidation();
    $users = new Users();


    if(isset($_GET['del']))
    {
        $Id = $_GET['del'];
        if($attendance->deleteAttendance($Id, $_SESSION['orgId']))
        {
            header('location: viewall.php');
        }
    }

    if(isset($_POST['postAttendance']))
    {
        //echo 'hti'; die();
        foreach ($_POST as $key => $value)
        {
            $_POST[$key] = $validate->validateForm($value); //striping the user input            
        }
        if($attendance->postAttendance($_POST))
        {
            header('location: viewall.php');
        }
    }
    
?>

<div class="p-3">
    <div class="row">
        <div class="col-md-3">
            <button id="createAttendance" class="btn btn-info"><span><i class="fas fa-cash-register"></i></span> Take New Attendance</button>
        </div>
        <div class="col-md-2">
            <input type="date" name="dates" id="pickdate" class="form-control datefield" placeholder="Pick a date">
            <input type="hidden" name="orgId" id="orgId" value="<?php echo $_SESSION['orgId']?>">
        </div>
    </div>
</div>

<!-- DataTales Example -->
<div class="pt-0 pl-3 pr-3">    
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Attendance sheet for: <?php echo $org->getOrgName($_SESSION['orgId'])?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Males</th>
                        <th>Females</th>
                        <th>Children</th>
                        <th>Total</th>
                        <th>Posted by</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Males</th>
                        <th>Females</th>
                        <th>Children</th>
                        <th>Total</th>
                        <th>Posted by</th>
                    </tr>
                </tfoot>
                <tbody class="text-dark">
                    <?php
                        //$data[] = array();
                        $count = 0;
                        $list = $attendance->getAllAttendanceList($_SESSION['orgId']);
                        while($result = $list->getResults())
                        {
                            $data[] = $result;                                       
                        }                       
                        if(!empty($data))
                        {
                            foreach ($data as $key => $value)
                            {
                                #fetch user
                                $user = $users->getUser($value['userId'], $value['orgId']);
                                $date = toLongDateString($value['attendancedate']);
                                $total = $value['malecount'] + $value['femalecount'] + $value['childrencount'];
                                /**************************************************/
                                echo
                                '
                                    <tr>
                                        <td>'.++$count.'</td>
                                        <td>'.$date.'</td>
                                        <td>'.$value['malecount'].'</td>
                                        <td>'.$value['femalecount'].'</td>
                                        <td>'.$value['childrencount'].'</td>                                    
                                        <td>'.$total.'</td>
                                        <td>'.$user['username'].'</td>
                                        <td><a href="viewall.php?del='.$value['Id'].'"><i class="fas fa-trash text-danger"></i></a></td>
                                    </tr>
                                ';
                            }
                        }
                    ?>                                
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
        
        //create an atendance
        document.getElementById('createAttendance').addEventListener('click', function(){
            $('#postAttendance').modal('show')
        })

        
        let DOMelement = document.getElementById('attendancetable')
        document.getElementById('pickdate').addEventListener('change', function(){

            let pickdate = document.getElementById('pickdate').value
            let orgId = document.getElementById('orgId').value
            console.log(DOMelement)

            $.ajax({
                method: "GET",
                url: `ajax/fetch.php?date=${pickdate}&orgId=${orgId}`,
                success: function(resp){
                    let registerObj = JSON.parse(resp)
                    console.log(registerObj)
                    if(loadTable(registerObj, DOMelement, pickdate)){
                        document.getElementById('attendanceTitle').innerHTML = "Attendance Record for: " + pickdate
                        $('#attendanceRegister').modal('show')
                    }
                }
            })
        })

        function loadTable(arr, DOMelement, datex)
        {
            DOMelement.textContent = "";  //clear the dom first
            console.log('here')
            //let total = 0;
            if(arr.length > 0)
            {
                for (let index = 0; index < arr.length; index++)
                {
                    let total = parseInt(arr[index].malecount) + parseInt(arr[index].femalecount) + parseInt(arr[index].childrencount)
                    var tRow = document.createElement('tr'); //for data
                    
                    var tData2 = document.createElement("td");
                    var tData3 = document.createElement('td');
                    var tData4 = document.createElement('td');
                    var tData5 = document.createElement('td');
                   
                    tData2.appendChild(document.createTextNode(arr[index].malecount))
                    tData3.appendChild(document.createTextNode(arr[index].femalecount))
                    tData4.appendChild(document.createTextNode(arr[index].childrencount))
                    tData5.appendChild(document.createTextNode(total))
                    tRow.appendChild(tData2)
                    tRow.appendChild(tData3)
                    tRow.appendChild(tData4)
                    tRow.appendChild(tData5)
                    
                    DOMelement.appendChild(tRow);
                }
            }
            else
            {
                var paragraph = document.createElement('p'); //for total
                paragraph.appendChild(document.createTextNode(`Sorry no data available for the selected date (${datex})`))
                paragraph.setAttribute('class', "text-danger font-weight-bold p-2")
                DOMelement.appendChild(paragraph)
            }
            return true;
        }
    })
</script>