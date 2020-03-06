<?php 
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if(isset($_POST['leadFormSubmit'])){
       
        $amount     = $_POST['debtAmt'];
        $duePayment = $_POST['debt_due_payment'];
        $state      = $_POST['state'];
        $fName      = $_POST['fName'];
        $lName      = $_POST['lName'];
        $phone      = $_POST['phone'];
        $email      = $_POST['email'];

        $nameFilter = '/^[a-zA-Z]+(\s[a-zA-Z]+)?$/';
        $phoneFilter = '/^[0-9]*$/gm';

        foreach($_POST as $arr){
            if(empty($arr)){
                $msg['status'] = 'Step Missed';
                echo json_encode($msg['status']);
                exit;
            }
        }

        $html = 

        <<<HTML
        
            <h2>Check out lead query</h2>  
            <table style="border-color: #666;" cellpadding="3">
                <tbody>
                    <tr style='background: #eee;'>
                        <th>Name<th>
                        <td>$fName $lName<td>
                    </tr>
                    <tr style='background: #eee;'>
                        <th>Phone<th>
                        <td>$phone<td>
                    </tr>
                    <tr style='background: #eee;'>
                        <th>Email<th>
                        <td>$email<td>
                    </tr>
                    <tr style='background: #eee;'>
                        <th>State<th>
                        <td>$state<td>
                    </tr>
                    <tr style='background: #eee;'>
                        <th>Due Behind<th>
                        <td>$duePayment<td>
                    </tr>
                    <tr style='background: #eee;'>
                        <th>Loan Amount<th>
                        <td>$amount<td>
                    </tr>
                </tbody>
            </table>
        HTML;


        
       
        // Load Composer's autoloader
       // require 'vendor/autoload.php';

        require '../PHPMailer/src/Exception.php';
        require '../PHPMailer/src/PHPMailer.php';
        require '../PHPMailer/src/SMTP.php';

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            // delete or comment SMTPOptions if you are using online sever
            $mail->SMTPOptions = array(
            'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            //Server settings
            $mail->SMTPDebug = false;
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   =  true;                                   // Enable SMTP authentication
            $mail->Username   = '';                     // SMTP username
            $mail->Password   = '';                               // SMTP password
            $mail->SMTPSecure =  PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       =  587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('30.movie.download@gmail.com', '30.movie');
            $mail->addAddress('30.movie.download@gmail.com', 'one new lead');     // Add a recipient
           // $mail->addAddress('ellen@example.com');               // Name is optional
           // $mail->addReplyTo('info@example.com', 'Information');
           // $mail->addCC('cc@example.com');
           // $mail->addBCC('bcc@example.com');

            // Attachments
           /*  $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name */

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'New Lead Query';
            $mail->Body    = $html;
            $mail->AltBody = $html;

            $mail->send();
            $msg['status'] = 'success';
            echo json_encode($msg['status']);
            exit;
            
        } catch (Exception $e) {
             $msg['status'] = 'mailerror';
            echo json_encode($msg['status']);
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            
        }

        

    }
?>