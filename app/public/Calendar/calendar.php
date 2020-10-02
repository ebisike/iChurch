<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');

    $calendar = new Calendar();
    if(isset($_GET['del']))
    {
        $date = $_GET['del'];
        $calendar->DeleteCalendarEvent($date, $_SESSION['orgId']);
    }
?>

<div class="p-3">
<a href="create_calendar_event.php" class="btn btn-primary p-2 font-weight-bold"> <i class="fa fa-plus fa-1x bg-primary p-2 text-white"></i> Add Calendar Event</a>
</div>
<div class="form-group row ml-3">
    <label for="" class="col-md-4 float-lg-right">Pick a Date</label>
    <div class="col-md-4">
        <input type="date" name="" id="calendarDate" class="form-control">
    </div>
</div>

<!-- DataTales Example -->
<div class="pt-0 pl-3 pr-3">
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Event records</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Event Name</th>
                        <th>Date Hosted</th>
                        <th>Number of Guest</th>                  
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Event Name</th>
                        <th>Date Hosted</th>
                        <th>Number of Guest</th>
                    </tr>
                </tfoot>
                <tbody class="text-dark">
                    <?php
                        $count = 0;
                        $results = $calendar->GetCalendarAllEvents($_SESSION['orgId']);
                        while($result = $results->getResults())
                        {
                            $date = toLongDateString($result['EventDate']);
                            echo
                            '
                                <tr>
                                    <td>'.++$count.'</td>
                                    <td>'.$result['Title'].'</td>
                                    <td>'.$date.'</td>
                                    <td>'.$result['Descriptions'].'</td>
                                    <td>'.$result['Organizers'].'</td>
                                    <td><a href="calendar.php?del='.$result['EventDate'].'"><i class="fa fa-trash fa-1x text-danger"></i></a></td>
                                </tr>
                            ';
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
    $(document).ready(function (){
        let popup = document.getElementById('calendarDetails')
        document.getElementById('calendarDate').addEventListener('change', function(e){
            let calendarDate = $('#calendarDate').val()
            let orgId = <?php echo $_SESSION['orgId']?>;
            console.log("value is: " + calendarDate)
            //$('#calendarPopUp').modal()

            $.ajax({
                method: "GET",
                url: `ajax/calendarselector.php?select=${calendarDate}`,
                success: function(resp){
                    var resp = JSON.parse(resp)
                    console.log(resp)
                    showPopUp(resp)
                },
                error: function(resp){
                    console.log(resp)
                    showPopUp(resp)

                }
            })

            function showPopUp(resp){
                popup.textContent = ""
                popup.setAttribute('class', 'text-center')
                if(resp.length == 0){
                    noResultFound()
                }else{
                    fillData(resp)
                }
                $('#calendarPopUp').modal()
            }

            function fillData(resp){
                let title = document.createElement('h2')
                let desc = document.createElement('p')
                let org = document.createElement('p')
                let cDate = document.createElement('p')

                title.appendChild(document.createTextNode(resp[0].Title))
                desc.appendChild(document.createTextNode(resp[0].Descriptions))
                org.appendChild(document.createTextNode("Organanised by: " + resp[0].Organizers))
                cDate.appendChild(document.createTextNode(resp[0].EventDate))

                title.setAttribute('class', 'font-weight-bold text-uppercase p-3 m-2 bg-primary text-light')
                desc.setAttribute('class', 'p-2 font-weight-bold')

                popup.appendChild(title)
                popup.appendChild(desc)
                popup.appendChild(org)
                popup.appendChild(cDate)
            }

            function noResultFound(){
                let title = document.createElement('h2')
                title.setAttribute('class', 'font-weight-bold text-uppercase p-3 m-2 bg-danger text-light')
                title.appendChild(document.createTextNode("No Event For The Selected Date"));
                popup.appendChild(title)
            }
        })
    })
</script>