
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
      
      // Load the reservation email template
      $templatePath = dirname(__FILE__) . '/../email-templates/reservation-confirmation.html';
      
      if (!file_exists($templatePath)) {
            $result = '<div class="alert alert-danger alert-dismissible" role="alert">';
            $result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            $result .= 'Email template not found. Please contact administrator.';
            $result .= '</div>';
            echo $result;
            die();
      }
      
      $body = file_get_contents($templatePath);
      
      if ($body === false) {
            $result = '<div class="alert alert-danger alert-dismissible" role="alert">';
            $result .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            $result .= 'Unable to load email template. Please contact administrator.';
            $result .= '</div>';
            echo $result;
            die();
      }
      
      // Replace placeholder values with actual reservation data
      $body = str_replace('guest@example.com', $from, $body);
      $body = str_replace('+30 123 456 7890', $phoneNumber, $body);
      $body = str_replace('October 20, 2025', date('F j, Y', strtotime($dateFrom)), $body);
      $body = str_replace('October 27, 2025', date('F j, Y', strtotime($dateTo)), $body);
      $body = str_replace('2 people', $people . ' ' . ($people == 1 ? 'person' : 'people'), $body);

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
