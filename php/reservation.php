
<?php
      
      $errors = array();


      $dateFrom = $_POST['dateFrom'];
      $dateTo = $_POST['dateTo'];
      $people = $_POST['people'];
      $phoneNumber = $_POST['phoneNumber'];
      $email = $_POST['email'];

      // Check if date has been entered
      if (empty($dateFrom) && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateFrom)) {
            $errors['dateFrom'] = 'Please enter start date of reservation';
      }

      // Check if time has been entered
      if (empty($dateTo) && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateTo)) {
            $errors['dateTo'] = 'Please select end date of reservation';
      } 

      //Check if people has been entered
      if (!isset($people)) {
            $errors['people'] = 'Please enter the number of people for reservation';
      }

      if(!isset($phoneNumber)){
            $errors['phoneNumber'] = 'Please enter your phone number';
      }

      // Check if email has been entered and is valid
      if (!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address';
      }

      $errorOutput = '';

      if(!empty($errors)){

            $errorOutput .= '<div class="alert alert-danger alert-dismissible" role="alert">';
            $errorOutput .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';

            $errorOutput  .= '<ul>';

            foreach ($errors as $key => $value) {
                  $errorOutput .= '<li>'.$value.'</li>';
            }

            $errorOutput .= '</ul>';
            $errorOutput .= '</div>';

            echo $errorOutput;
            die();
      }

      $from = $email;
      $to = 'contact@wavepoint-apartments.com';  
      $subject = 'New Booking: Wavepoint Apartment';
      $subject2 = 'Reservation Availability: Wavepoint Apartment';
      
      $body = '<!doctypehtml><style>body{font-family:Arial,sans-serif;margin:0;padding:0;background-color:#f4f4f4}.email-container{width:100%;max-width:600px;margin:20px auto;background-color:#fff;border-radius:5px;box-shadow:0 0 10px rgba(0,0,0,.1);padding:20px}.email-header{font-size:24px;font-weight:700;text-align:center;color:#333;margin-bottom:20px}.email-content{font-size:16px;color:#555;line-height:1.5}.email-content p{margin:10px 0}.email-footer{text-align:center;font-size:14px;color:#999;margin-top:20px}</style><div class=email-container><div class=email-header>Reservation Details</div><div class=email-content><p><strong>From:</strong> E-Mail: '.$from.'<p><strong>Phone number:</strong> '.$phoneNumber.'<p><strong>Check-in:</strong> '.$dateFrom.'<p><strong>Check-out:</strong> '.$dateTo.'<p><strong>Number of guests:</strong> '.$people.'</div><div class=email-footer>Thank you for your reservation, We will contact you soon!</div></div>';

      // $headers = "From: ".$from;
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      // Additional headers
      $headers .= 'From: '.$from . "\r\n";  // Replace with your "From" address
      $headers .= 'X-Mailer: PHP/' . phpversion();

      
      $headers2 = "MIME-Version: 1.0" . "\r\n";
      $headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      // Additional headers
      $headers2 .= 'From: '.$to . "\r\n";  // Replace with your "From" address
      $headers2 .= 'X-Mailer: PHP/' . phpversion();

      //send the email
      $result = '';
      $result2 = '';
      if (mail ($to, $subject, $body, $headers)) {
            
            if(mail ($from, $subject2, $body, $headers2)) {
                  $result2 .= 'Email sent successfully.';
              } else {
                  $result2 .= 'Failed to send email.';
              }

            $result .= '<div class="alert alert-success alert-dismissible" role="alert">';
            $result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            $result .= 'Thank You! We will contact you shortly.';
            $result .= '</div>';

            echo $result;
            die();
      }

      $result = '';
      $result .= '<div class="alert alert-danger alert-dismissible" role="alert">';
      $result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
      $result .= 'Something bad happend during sending this message. Please try again later';
      $result .= '</div>';

      echo $result;
