
<?php
      
      $errors = array();

      // Check if date has been entered
      if (!isset($_POST['dateFrom'])) {
            $errors['dateFrom'] = 'Please enter start date of reservation';
      }

      // Check if time has been entered
      if (!isset($_POST['dateTo'])) {
            $errors['dateTo'] = 'Please select end date of reservation';
      }
      
      //Check if people has been entered
      if (!isset($_POST['people'])) {
            $errors['people'] = 'Please enter the number of people for reservation';
      }

      // Check if email has been entered and is valid
      if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
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


      $datefrom = $_POST['dateFrom'];
      $dateTo = $_POST['dateTo'];
      $people = $_POST['people'];
      $email = $_POST['email'];
      $from = $email;
      $to = 'contact@wavepoint-apartments.com';  // please change this email id
      $subject = 'New Booking: Wavepoint Apartment';
      
      $body = "From: E-Mail: $email\n From: $dateFrom\n To: $dateTo\n Number of people: $people";

      $headers = "From: ".$from;

      //send the email
      $result = '';
      if (mail ($to, $subject, $body, $headers)) {
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
