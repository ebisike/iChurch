<?php
    require ('../shared/_sidebar.php');
    require ('../shared/_topbar.php');
?>

<div class="pt-1 pl-3 pr-3">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-5">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-3 d-none d-lg-block bg-password-image"></div>
            <div class="col-lg-9">
            <div class="p-5">
                <div class="text-center">
                <h1 class="h4 text-gray-900 mb-2">Members Registration Form</h1>
                <p class="mb-4">Fiil out all informations about your church member</p>
                </div>
                
                <div class="tab">
                    <button class="tablinks" onclick="openCity(event, 'Basic')" id="defaultOpen">Basic</button>
                    <button class="tablinks" onclick="openCity(event, 'Contact')">Contact</button>
                    <button class="tablinks" onclick="openCity(event, 'Marital')">Marital</button>
                    <!-- <button class="tablinks" onclick="openCity(event, 'Children')">Children</button> -->
                    <button class="tablinks" onclick="openCity(event, 'Social')">Social</button>
                    <button class="tablinks" onclick="openCity(event, 'Church')">Church</button>
                </div>
                <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                    <input type="hidden" name="orgId" value="<?php echo $_SESSION['orgId']?>">
                    <input type="hidden" name="userId" value="<?php echo $_SESSION['userId']?>">
                    <!-- <input type="hidden" name="familyId" value="<?php //echo $_SESSION['familyId']?>"> -->
                    <input type="hidden" name="familyId" value="10001">
                    <div id="Basic" class="tabcontent m-3">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Stewardship number *</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Stewardship number..." name="stewardship" required>                            
                                </div>                                    
                                <div class="form-group">
                                <!-- <label>Stewardship number *</label> -->
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Last Name..." name="lastName" required>                            
                                </div>
                                <div class="form-group">
                                <!-- <label>Stewardship number *</label> -->
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter First Name..." required name="firstName">                            
                                </div>
                                <div class="form-group">
                                <!-- <label>Stewardship number *</label> -->
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Other Name..." name="otherName">                            
                                </div>                                
                            </div>
                            <div class="col-md-4 bg-gradient-light p-2 m-0">
                                <div class="form-group">
                                    <label>upload a passport</label>
                                    <input type="file" name="file" class="form-control" value="1.jpg">
                                </div>                                
                                <div class="form-group">
                                    <label>Date of Birth *</label>
                                    <input type="date" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Last Name..." required name="dateOfBirth">                            
                                </div>
                                <div class="form-group">
                                <!-- <label>Stewardship number *</label> -->
                                    <select name="gender" id="" class="form-control" required>
                                        <option value="0">---Gender---</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div><hr>
                        <button class="btn btn-default shadow" id="next">
                            <i class="fas fa-arrow-right fa-sm"></i>
                        </button>
                    </div>

                    <div id="Contact" class="tabcontent m-3">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                <!-- <label>Stewardship number *</label> -->
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Contact Address..." required name="addresss">                            
                                </div>
                                <div class="form-group">
                                <!-- <label>Stewardship number *</label> -->
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Sample: example@example.com..." name="email">                            
                                </div>
                                <div class="form-group">
                                <!-- <label>Stewardship number *</label> -->
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Phone Number..." required name="phone1">                            
                                </div>
                                <div class="form-group">
                                <!-- <label>Stewardship number *</label> -->
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Another Phone Number..." name="phone2">                            
                                </div>
                            </div>
                            <div class="col-md-4 p-2 bg-gradient-dark">
                                <div class="form-group">
                                    <label>State of origin *</label>
                                    <select class="form-control" name="stateOfOrigin" required>
                                        <option value="Abia">Abia</option>
                                        <option value="Adamawa">Adamawa</option>
                                        <option value="Akwa Ibom">Akwa Ibom</option>
                                        <option value="Anambra">Anambra</option>
                                        <option value="Bauchi">Bauchi</option>
                                        <option value="Bayelsa">Bayelsa</option>
                                        <option value="Benue">Benue</option>
                                        <option value="Borno">Borno</option>
                                        <option value="Cross River">Cross River</option>
                                        <option value="Delta">Delta</option>
                                        <option value="Ebonyi">Ebonyi</option>
                                        <option value="Edo">Edo</option>
                                        <option value="Ekiti">Ekiti</option>
                                        <option value="Enugu">Enugu</option>
                                        <option value="Gombe">Gombe</option>
                                        <option value="Imo">Imo</option>
                                        <option value="Jigawa">Jigawa</option>
                                        <option value="Kaduna">Kaduna</option>
                                        <option value="Kano">Kano</option>
                                        <option value="Kastina">Kastina</option>
                                        <option value="Kebbi">Kebbi</option>
                                        <option value="Kogi">Kogi</option>
                                        <option value="Kwara">Kwara</option>
                                        <option value="Lagos">Lagos</option>
                                        <option value="Nassarawa">Nassarawa</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Ogun">Ogun</option>
                                        <option value="Ondo">Ondo</option>
                                        <option value="Osun">Osun</option>
                                        <option value="Oyo">Oyo</option>
                                        <option value="Plateau">Plateau</option>
                                        <option value="Rivers">Rivers</option>
                                        <option value="Sokoto">Sokoto</option>
                                        <option value="Taraba">Taraba</option>
                                        <option value="Yobe">Yobe</option>
                                        <option value="Zamfara">Zamfara</option>
                                        <option value="FCT">FCT</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                <!-- <label>Stewardship number *</label> -->
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Local Government Area..." required name="lga">                            
                                </div>
                                <div class="form-group">
                                <!-- <label>Stewardship number *</label> -->
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Town/Village..." name="village">                            
                                </div>
                            </div>
                        </div><hr>
                        <button class="btn btn-default shadow mr-3" type="button" id="prev">
                            <i class="fas fa-arrow-left fa-sm"></i>
                        </button>
                        <button class="btn btn-default shadow" type="button" id="next">
                            <i class="fas fa-arrow-right fa-sm"></i>
                        </button>
                    </div>

                    <div id="Marital" class="tabcontent m-3">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Marital Status *</label>
                                    <select name="maritalStatus" id="" class="form-control" required>
                                        <option value="single">single</option>
                                        <option value="marrried">marrried</option>
                                        <option value="separated">separated</option>
                                        <option value="widowed">widowed</option>
                                        <option value="widower">widower</option>
                                    </select>
                                </div>                                    
                                <div class="form-group">
                                <!-- <label>Stewardship number *</label> -->
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Name of Spouse..." name="nameOfSpouse" >                            
                                </div>
                                <div class="form-group">
                                    <label>Nature of Marriage *</label>
                                    <select name="natureOfMarriage" id="" class="form-control" required>
                                        <option value="unmarried">unmarried</option>
                                        <option value="Traditional">Traditional</option>
                                        <option value="Ordinance">Ordinance</option>
                                        <option value="Blessing">Blessing</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Date of Marriage *</label>
                                    <input type="date" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Marriage Date..." name="dateOfMarriage">                            
                                </div>
                                <div class="form-group">                                    
                                    <input type="number" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Number of Children..." name="numberOfChildren">                            
                                </div>
                            </div>
                            <div class="col-md-4 p-2 bg-gradient-light">

                            </div>
                        </div><hr>
                        <button class="btn btn-default shadow mr-3" type="button" id="prev">
                            <i class="fas fa-arrow-left fa-sm"></i>
                        </button>
                        <button class="btn btn-default shadow" type="button" id="next">
                            <i class="fas fa-arrow-right fa-sm"></i>
                        </button>
                    </div>                

                    <div id="Social" class="tabcontent m-3">
                        <div class="row">
                            <div class="col-md-8 p-2">
                                <div class="form-group">
                                    <label>Highest Academic Qualification *</label>
                                    <select class="form-control" required name="academic">
                                        <option value="FSLC">FSLC</option>
                                        <option value="O level">O level</option>
                                        <option value="ND">ND</option>
                                        <option value="HND">HND</option>
                                        <option value="BSc.">BSc.</option>
                                        <option value="MSc.">MSc.</option>
                                        <option value="PHD">PHD</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Occupation *</label>
                                    <input list="income" class="form-control" placeholder="Enter Occupation" name="profession" required>
                                    <datalist id="income">
                                        <option value="Civil servant">
                                        <option value="Entrepreneur">
                                        <option value="Student">
                                    </datalist>
                                </div>
                                <div class="form-group">
                                    <label>Nature of Business</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Describe your business..." name="occupation">  
                                </div>
                                <div class="form-group">
                                    <label>Business Address</label>
                                    <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="business address..." name="occupationAddress">  
                                </div>                              
                            </div>
                            <div class="col-md-4 bg-gradient-light"></div>
                        </div><hr>
                        <button class="btn btn-default shadow mr-3" type="button" id="prev">
                            <i class="fas fa-arrow-left fa-sm"></i>
                        </button>
                        <button class="btn btn-default shadow" type="button" id="next">
                            <i class="fas fa-arrow-right fa-sm"></i>
                        </button>
                    </div>

                    <div id="Church" class="tabcontent m-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Are you Baptized? *</label><br>
                                    <label class="radio-inline">
                                        <input type="radio" name="isBaptised" value="No">No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="isBaptised" value="Yes">Yes
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Date of Baptism *</label>
                                    <input type="date" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Marriage Date..." required name="baptismDate">                            
                                </div>                                
                                <div class="form-group">
                                    <label>Group *</label>
                                    <select class="form-control" name="group">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Are you Confirmed? *</label><br>
                                    <label class="radio-inline">
                                        <input type="radio" name="isConfirmed" value="No">No
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="isConfirmed" value="Yes">Yes
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Date of Confirmation *</label>
                                    <input type="date" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Marriage Date..." name="confirmationDate">                            
                                </div>
                            </div>
                        </div><hr>
                        <button class="btn btn-default shadow mr-3" type="button" id="prev">
                            <i class="fas fa-arrow-left fa-sm"></i>
                        </button>
                        <button class="btn btn-primary shadow" type="submit" name="submit">
                            <i class="fas fa-paper-plane fa-sm"></i>
                        </button>
                    </div>
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