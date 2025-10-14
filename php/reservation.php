
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
      
      $body = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }
        
        .email-container {
            max-width: 650px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .email-hero {
            position: relative;
            height: 250px;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                        url("https://www.wavepoint-apartments.com/assets/images/ApartmentHero.jpg");
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .email-hero h1 {
            color: white;
            font-size: 32px;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            text-align: center;
        }
        
        .email-content {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .reservation-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
            padding: 25px;
            margin: 25px 0;
            border-left: 5px solid #007bff;
        }
        
        .reservation-card h3 {
            color: #2c3e50;
            font-size: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #dee2e6;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: #495057;
            font-size: 16px;
        }
        
        .detail-value {
            color: #007bff;
            font-weight: 500;
            font-size: 16px;
        }
        
        .contact-info {
            background: #007bff;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin: 25px 0;
            text-align: center;
        }
        
        .contact-info h4 {
            margin-bottom: 10px;
            font-size: 18px;
        }
        
        .contact-info p {
            margin: 5px 0;
            opacity: 0.9;
        }
        
        .email-footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #dee2e6;
        }
        
        .footer-text {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 15px;
        }
        
        .social-links {
            margin-top: 20px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 25px;
            display: inline-block;
            margin: 10px 5px;
            font-weight: 600;
            transition: transform 0.2s;
        }
        
        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 10px;
            }
            
            .email-content {
                padding: 20px 15px;
            }
            
            .email-hero h1 {
                font-size: 24px;
            }
            
            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-hero">
            <h1>Wavepoint Apartments</h1>
        </div>
        
        <div class="email-content">
            <div class="greeting">
                <strong>Thank you for your reservation request!</strong><br>
                We have received your booking details and will contact you shortly.
            </div>
            
            <div class="reservation-card">
                <h3>📋 Reservation Details</h3>
                <div class="detail-row">
                    <span class="detail-label">📧 Email:</span>
                    <span class="detail-value">'.$from.'</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">📱 Phone:</span>
                    <span class="detail-value">'.$phoneNumber.'</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">📅 Check-in:</span>
                    <span class="detail-value">'.date('F j, Y', strtotime($dateFrom)).'</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">📅 Check-out:</span>
                    <span class="detail-value">'.date('F j, Y', strtotime($dateTo)).'</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">👥 Guests:</span>
                    <span class="detail-value">'.$people.' '.($people == 1 ? 'person' : 'people').'</span>
                </div>
            </div>
            
            <div class="contact-info">
                <h4>🏢 Contact Information</h4>
                <p><strong>Email:</strong> contact@wavepoint-apartments.com</p>
                <p><strong>Website:</strong> www.wavepoint-apartments.com</p>
                <p>We will review your request and confirm availability within 24 hours.</p>
            </div>
        </div>
        
        <div class="email-footer">
            <div class="footer-text">
                <strong>What happens next?</strong><br>
                Our team will review your reservation request and check availability for your selected dates.
                You will receive a confirmation email within 24 hours with further instructions.
            </div>
            <div class="footer-text">
                Questions? Feel free to contact us at any time!
            </div>
            <div style="margin-top: 20px; color: #adb5bd; font-size: 12px;">
                © '.date('Y').' Wavepoint Apartments. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>';

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
