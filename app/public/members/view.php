<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');

    if(isset($_GET['find']))
    {
        $memberId = $_GET['find'];
        $data = $members->getMember($memberId, $_SESSION['orgId']);
        if($data != NULL)
        {
            $imgsrc = 'passports/'. $data['imagepath'];
            //fectch the details of the user that add the member
            $userInfo = $user->getUser($data['userId'], $data['orgId']);
        }
    }

?>

<div class="pt-0 pl-md-5 pr-md-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body pt-3 pl-5 pr-5 pb-3">

                    <div>
                        <div class="p-2 bg-light mb-2">
                            Posted by: <?php echo  $userInfo['firstName'].' '.$userInfo['lastName']?>
                        </div>                        
                        <img src="<?php echo $imgsrc ?>" alt="passport" class="img img-responsive img-thumbnail">
                        <label class="text-capitalize">
                            stewardship: <?php echo $data['stewardship']?><br>
                            family ID: <?php echo $data['familyId']?>
                        </label>
                    </div>
                    <div id="name">
                        <p class="text-capitalize text-dark font-weight-bold p-2 border-bottom bg-gradient-light">
                            <?php echo $data['firstName'].' '.$data['otherName'].' '.$data['lastName'] ?>
                            <span class="float-right">Age: <?php echo calculateAge($data['dateOfBirth']) .' Years' ?></span>
                        </p>
                    </div>
                    <div>
                        <p class="text-dark">
                            <i class="fa fa-phone-square-alt text-info"></i> <?php echo $data['phone1'] ?><br>
                            <i class="fa fa-phone-square-alt text-info"></i> <?php echo $data['phone2']?><br>
                            <i class="fa fa-envelope-square text-info"></i> <?php echo strtolower($data['email']) ?>                          
                        </p>
                        <div class="p-3 bg-dark text-white">
                            Action buttons | 
                            <a href="editmember.php?edit=<?php echo $data['Id']?>"><i class="fa fa-pen text-white"></i></a>
                            <a href="editmember.php?delete=<?php echo $data['Id']?>"><i class="fa fa-trash text-white"></i></a>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body pt-3 pl-5 pr-5 pb-3">
                            <div class="p-2 border-bottom"> Contact | Marital info</div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="pt-2 pb-2 text-dark">
                                        <i class="fa fa-address-book text-info"></i> <?php echo $data['addresss']?><br>
                                        <i class="fa fa-globe-africa text-info"></i> <?php echo $data['stateoforigin']?><br>
                                        <i class="fa fa-globe-asia text-info"></i> <?php echo $data['lga'].' local government area'?><br>
                                        <i class="fa fa-globe-asia text-info"></i> <?php echo $data['village'].' village'?>
                                    </div>
                                </div>
                                <?php 
                                    if($data['maritalstatus'] != 'single')
                                    {
                                        echo
                                        '
                                            <div class="col-md-6">
                                                <div class="pt-2 pb-2 text-dark">
                                                    <i class="fa fa-heart text-danger"></i> '.strtoupper($data['maritalstatus']).'<br>
                                                    <i class="fa fa-pen text-info"></i> '.$data['nameofspouse'].'<br>
                                                    <i class="fa fa-grin-tongue text-info"></i> '.$data['natureofmarriage'].'<br>
                                                    <i class="fa fa-calendar-check text-info"></i> '.toLongDateString($data['dateofmarriage']).'<br>
                                                    <i class="fa fa-people-carry text-info"></i> '.$data['numberofchildren'].' children<br>
                                                </div>
                                            </div>
                                        ';
                                    }else
                                    {
                                        echo 'single';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card o-hidden border-0 shadow-lg">
                        <div class="card-body pt-3 pl-5 pr-5 pb-3">
                            <div class="p-2 border-bottom">Social | Church info</div>
                            <div class="row" id="social">
                                <div class="col-md-6">
                                    <div class="pt-2 pb-2 text-dark">
                                        <i class="fa fa-graduation-cap text-info"></i> <?php echo $data['academicqualification']?><br>
                                        <i class="fa fa-toolbox text-info"></i> <?php echo $data['profession']?><br>
                                        <i class="fa fa-tools text-info"></i> <?php echo $data['occupation']?><br>
                                        <i class="fa fa-address-card text-info"></i> <?php echo $data['occupationaddress'].' village'?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="pt-2 pb-2 text-dark">
                                        <i class="fa fa-church text-info"></i> <?php echo $data['isbaptised'] ? 'Baptised': 'Not Baptised'?><br>
                                        <i class="fa fa-calendar-alt text-info"></i> <?php echo toLongDateString($data['baptismdate'])?><br>
                                        <i class="fa fa-church text-info"></i> <?php echo $data['isconfirmed'] ? 'Confirmed' : 'Not Confirmed'?><br>
                                        <i class="fa fa-calendar-day text-info"></i> <?php echo toLongDateString($data['confirmationdate'])?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5 mb-5">
                <div class="col-md-12">
                    <div class="card o-hidden border-0 shadow-lg">
                        <div class="card-body pt-3 pl-5 pr-5 pb-3">
                            <div class="p-2 border-bottom">Children Info</div>
                            <div class="row">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Fullname</th>
                                            <th>Date of Birth</th>
                                            <th>Age</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $results = $child->getMemberChildren($data['Id'], $data['orgId']);
                                            $count = 0;
                                            while($result = $results->getResults())
                                            {
                                                echo
                                                '
                                                    <tr style="font-size: 13px">
                                                        <td>'.++$count.'</td>
                                                        <td>'.$data['lastName'].' '.$result['firstName'].' '.$result['otherName'].'</td>
                                                        <td>'.toShortDateString($result['dateOfBirth']).'</td>
                                                        <td>'.calculateAge($result['dateOfBirth']).'</td>
                                                        <td><a href="editchild.php?id='.$result['Id'].'"><i class="fa fa-pen-alt"></i></a></td>
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
            </div>

        </div>
    </div>
</div>
<script src="../../bootstrap/js/custom/details-url.js"></script>
<?php
     require ('../shared/_footer.php');
?>