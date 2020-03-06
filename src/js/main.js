$(document).ready(function(){

    const stepName = ['step-estimated_debt', 'step-behind_due', 'statesName','step-personalDetails'];
    let stepCount = 0;
    $('.backBtn').hide();
    $('.nextBtn').hide();
      $(function () {
          $("#step-box__slider").slider({
              range: "max",
              min: 1000,
              max: 100000,
              
              slide: function (event, ui) {
                  let plus = '';
                  ui.value > 99000 ? plus ='+' : pluse = ''; 
                  $("#step-box__sliderAmt").text('$' + ui.value + plus);
                  let debtAmt = $("#step-estimated_debt input[name='debtAmt']").val(ui.value);
              }
          });
          let stepValue = $("#step-box__slider").slider('option',"step",1000);
          
          $("#step-box__sliderAmt").text('$1,000');
      });

   

    $('.backBtn').click(function(e){
        e.preventDefault();
        stepCount--;
        if (stepCount <= 0) {
            $(this).hide();
        }
        $('.backBtn').attr('href', '#' + stepName[stepCount]);
        $('.tab-pane').removeClass('show active');
        let getPreTab = $('.backBtn').attr('href');
        $(getPreTab).addClass('show active');
        $('.nextBtn').show();
        nextBtnShow();
    });

    $('.nextBtn').click(function (e) {
        e.preventDefault();
        stepCount++;
        if (stepCount == stepName.length) {
            $(this).hide();
        }
        $('.nextBtn').attr('href', '#' + stepName[stepCount]);
        $('.tab-pane').removeClass('show active');
        let getNextTab = $('.nextBtn').attr('href');
        $(getNextTab).addClass('show active');
        $('.backBtn').show();
        nextBtnShow();
    });

    function nextBtnShow(){
        $('.nextBtn').hide();
        if(stepCount == 0){
            let behindDue = $('#step-behind_due input[name="debt_due_payment"]:checked').val();
           
            if(behindDue != ''){
                $('.nextBtn').show();
            }
        }

        if(stepCount == 1){
            let stateLive = $('#statesName select[name="state"]').val();
            if (stateLive != '') {
                $('.nextBtn').show();
            }
           
        }
        if(stepCount == 2){
            let fName = $('#step-personalDetails input[name="fName"]').val().trim();
            let lName = $('#step-personalDetails input[name="lName"]').val().trim();
            let email = $('#step-personalDetails input[name="email"]').val().trim();
            let phone = $('#step-personalDetails input[name="phone"]').val().trim();

            if(fName !='' || lName != '' || email != '' || phone != ''){
                $('.nextBtn').show();
            }
        }
    }


    $('#step-behind_due').click(function (e) {
        if($(e.target).hasClass('steps-box__due')) {
           let debtDueVal = $(e.target).find('input[name="debt_due_payment"]').prop('checked',true).val();
        }
    });

    $('#step-estimated_debt button').click(function(e){
        e.preventDefault();
        stepCount = 1;
        $('#step-estimated_debt').removeClass('show active');
        $('#step-behind_due').addClass('show active');
        $('.backBtn').attr('href','#'+ stepName[stepCount-1]);
        $('.backBtn').show();
        nextBtnShow();
    });

    $('#step-behind_due label').click(function(){
        stepCount = 2;
        $('#step-behind_due').removeClass('show active')
        $('#statesName').addClass('show active');
        $('.backBtn').attr('href', '#' + stepName[stepCount-1]);
        nextBtnShow();
    });

    $('#statesName select[name="state"]').change(function(){
        stepCount = 3;
        let stateLive = $('#statesName select[name="state"]').val();
            if (stateLive == '') {
                alert('select state');
                return;
            }
        $('#statesName').removeClass('show active');
        $('#step-personalDetails').addClass('show active');
        $('.backBtn').attr('href', '#' + stepName[stepCount-1]);
        nextBtnShow();
    });

    $('#debtLeadForm').submit(function(e){
        e.preventDefault();
        let validationError = true;
        let fName = $('#step-personalDetails input[name="fName"]').val().trim();
        let lName = $('#step-personalDetails input[name="lName"]').val().trim();
        let email = $('#step-personalDetails input[name="email"]').val().trim();
        let phone = $('#step-personalDetails input[name="phone"]').val().trim();
        let emailFilter = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
        let nameFilter = /^[a-zA-Z]+(\s[a-zA-Z]+)?$/;
        let phoneFilter = /^[0-9]*$/gm;
      
        if (fName == ''){
            $('#step-personalDetails input[name="fName"]').addClass('has-error');
            $('.fname_error').text('First name required');
            validationError = false;
        } else if (!nameFilter.test(fName)){
            $('#step-personalDetails input[name="fName"]').addClass('has-error');
            $('.fname_error').text('only alphabets allowed in first name.');
            validationError = false;
        }else{
            $('#step-personalDetails input[name="fName"]').removeClass('has-error');
            $('.fname_error').text('');
        }

        if(lName == ''){
            $('#step-personalDetails input[name="lName"]').addClass('has-error');
            $('.lname_error').text('Last name required');
            validationError = false;
        } else if (!nameFilter.test(lName)) {
            $('#step-personalDetails input[name="lName"]').addClass('has-error');
            $('.lname_error').text('only alphabets allowed in last name.');
            validationError = false;
        }else{
            $('#step-personalDetails input[name="lName"]').removeClass('has-error');
            $('.lname_error').text('');
        }

        if (email == '') {
            $('#step-personalDetails input[name="email"]').addClass('has-error');
            $('.email_error').text('email required');
            validationError = false;
        } else if(!emailFilter.test(email)){
            $('#step-personalDetails input[name="email"]').addClass('has-error');
            $('.email_error').text('Enter valid email address');
            validationError = false;
        } else {
            $('#step-personalDetails input[name="email"]').removeClass('has-error');
            $('.email_error').text('');
        }

        if (phone == '') {
            $('#step-personalDetails input[name="phone"]').addClass('has-error');
            $('.phone_error').text('Phone no is required');
            validationError = false;
        }else if(!phoneFilter.test(phone)){
            $('#step-personalDetails input[name="phone"]').addClass('has-error');
            $('.phone_error').text('Phone no must be in number');
            validationError = false;
        }else if(phone.length != 10){
            $('#step-personalDetails input[name="phone"]').addClass('has-error');
            $('.phone_error').text('Phone no must be 10 digits');
            validationError = false;
        } else {
            $('#step-personalDetails input[name="phone"]').removeClass('has-error');
            $('.phone_error').text('');
        }

        let formData = new FormData(this);

        if(validationError){
            $('.backBtn').attr('href', '#' + stepName[stepCount - 1]);
            nextBtnShow();
            $('#step-personalDetails .loader').removeClass('d-none');
            $('#step-personalDetails button').addClass('d-none');
           $.when(sendRequest(formData)).done(function(response){
                $('#step-personalDetails .loader').addClass('d-none');

                if(response == 'success'){
                    $('.debtLeadDiv').html('<h2>Thanks for Showing Interest.</h2><br><h2>We\'ll contact you soon.</h2>');
                }else{
                     $('#step-personalDetails button').removeClass('d-none');
                     alert(response);
                }
                
           });
        }
        
    });


    function sendRequest(formData){
        return $.ajax({
            url: 'include/processRequest.php',
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON'
        });
    }
    
    
});


