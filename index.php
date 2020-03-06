<?php include_once('lists.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bills</title>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="src/js/jqueryUi/jquery-ui.css">
    <link rel="stylesheet" href="src/css/bootstrap.css">
    <link rel="stylesheet" href="src/css/fontawesome/css/all.css" type="text/css">
    <link rel="stylesheet" href="src/css/style.css">
</head>
<body>

    <header>
        <div class="container-fluid">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-md-6 text-sm-center text-left">
                        <img src="src/img/bills-blue.png" alt="" >  
                    </div>
                    <div class="col-md-6 text-right text-sm-center mt-sm-2">
                        <h4>
                            <i class="fas fa-phone-alt"></i>
                            <span>(800) 610-4560</span>
                        </h4>
                    </div>
                </div>
                
            </div>
        </div>
    </header>
    <section class="container">
        <div class="row mt-5">
            <div class="col-md-8 m-auto bg-light border steps-box p-4 text-center debtLeadDiv">

                <a class="float-left backBtn" data-toggle="" href="" >
                    <i class="fas fa-arrow-alt-circle-left mr-2"></i>Back
                </a>

               
                <a href="" class="float-right nextBtn" data-toggle="step">Next <i class="fas fa-arrow-alt-circle-right ml-2"></i></a>

                <form action="" id="debtLeadForm" name="debtLeadForm">
                    <div class="tab-content">
                    <!-- step estimated debt -->
                    <div id="step-estimated_debt" class="tab-pane fade show active">
                        <h1 class="text-primary my-4 ">Choose your debt amount</h1>
                        <div class="row mt-4">
                            <div class="col-md-6 m-auto">
                                <input type="hidden" name="debtAmt" value="1000">
                                <h3 id="step-box__sliderAmt" class="my-3 custom-text-primary"></h3>
                                <div id="step-box__slider" class="my-2"></div>
                                <span class="float-left text-dark">$1,000</span>
                                <span class="float-right text-dark">$100,000+</span>
                            
                                <button class="btn btn-danger btn-lg mt-5 mb-2">
                                    Continue <i class="fas fa-arrow-alt-circle-right ml-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- step behind payment -->

                    <div id="step-behind_due" class="tab-pane fade">
                        <h1 class="text-primary my-4 ">Are you behind on your payments?</h1>
                        <div class="row mt-4">
                            <div class="col-md-6 m-auto">
                                <div class="d-flex flex-column">
                                    <label for="" class="steps-box__due">Yes - More than 60 Days
                                        <input type="radio" value="60" name="debt_due_payment">
                                    </label>
                                    <label for="" class="steps-box__due">Yes - 30 Days
                                        <input type="radio" value="30" name="debt_due_payment">
                                    </label>
                                    <label for="" class="steps-box__due">No
                                        <input type="radio" value="no" name="debt_due_payment">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- state -->
                    <div id="statesName" class="tab-pane fade">
                        <h1 class="text-primary my-4">What state do you live in?</h1>
                        <div class="row my-4">
                            <div class="col-md-6 m-auto">
                                <select name="state" id="" class="form-control">
                                    <option value="">Select</option>
                                    <?php 
                                        foreach($statesName as $state){
                                            echo "<option value='$state'>$state</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>        
                    </div> 
                    
                    <div id="step-personalDetails" class="tab-pane fade">
                        <h1 class="text-primary my-4">See your results</h1>
                        <div class="row my-4">
                            <div class="col-md-6 m-auto text-left">
                                <div class="form-group ">
                                    <input type="text" class="form-control" name="fName" placeholder="First Name">
                                    <span class="fname_error text-danger "></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="lName" placeholder="Last Name">
                                     <span class="lname_error text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone">
                                     <span class="phone_error text-danger"></span>
                                </div>
                                 <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                     <span class="email_error text-danger"></span>
                                </div>
                                <input type="hidden" name="leadFormSubmit" value="leadFormSubmit"> 
                                <div class="loader text-center d-none">
                                    <p class="text-warning mt-2">Please Wait</p>
                                    <img src="src/img/loader.gif" alt="" class="mt-3"> 
                                </div>
                                <button class="btn btn-danger btn-block my-2" type="submit">
                                Click to see your results <i class="fas fa-arrow-alt-circle-right ml-2"></i>
                                </button>
                            </div>
                        </div>        
                    </div> 
                </div><!--tab content-->
                </div><!--col-->
            </form>
        </div>
    </section>



    
    <script src="src/js/jquery.js"></script>
    <script src="src/js/jqueryUi/jquery-ui.js"></script>
    <script src="src/js/js/bootstrap.js"></script>
    <script src="src/js/main.js"></script>
</body>
</html>