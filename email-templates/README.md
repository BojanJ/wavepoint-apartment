# Wave Point Apartment - Email Templates

This directory contains HTML email templates designed to match the Wave Point Apartment website's Titan template design. These templates maintain consistent branding and styling with your main website.

## Templates Included

### 1. **reservation-confirmation.html**
- **Purpose**: Sent after a guest submits a reservation request
- **Features**: 
  - Displays reservation details (dates, guests, contact info)
  - Confirmation message and next steps
  - Action buttons for gallery, house manual, and location
  - Contact information section

### 2. **general-template.html**
- **Purpose**: Generic template for various email communications
- **Features**:
  - Customizable greeting and content sections
  - Info cards with styled lists
  - Action buttons section
  - Flexible content areas

### 3. **contact-response.html**
- **Purpose**: Auto-response for contact form submissions
- **Features**:
  - Confirmation of message receipt
  - Display of submitted message details
  - Response time expectations
  - Helpful links and contact information

## Design Features

All templates include:

### Visual Design
- **Color Scheme**: Matches website colors (#9a9382 primary, #2c3e50 text)
- **Typography**: Uses Open Sans and Roboto Condensed fonts (matches website)
- **Layout**: Responsive design that works on desktop and mobile
- **Branding**: Wave Point logo and consistent styling

### Email Compatibility
- **HTML Structure**: Table-free layout using CSS flexbox with fallbacks
- **Responsive**: Mobile-optimized with media queries
- **Email Client Support**: Tested styles for major email clients
- **Inline CSS**: All styles are embedded for maximum compatibility

### Components
- **Header**: Branded header with logo and title
- **Content Cards**: Styled information cards with gradient backgrounds
- **Buttons**: Titan template button styling (.btn, .btn-primary)
- **Footer**: Contact info, social links, and copyright
- **Responsive**: Mobile-friendly layout

## Customization Guide

### Colors
The main brand colors are defined as CSS variables equivalent:
- **Primary**: `#9a9382` (warm taupe)
- **Primary Hover**: `#8a8572` (darker taupe)
- **Secondary**: `#2c3e50` (dark blue-gray)  
- **Accent**: `#e5e5e5` (light gray)
- **Background**: `#f6f6f6` (off-white)

### Typography
- **Headers**: Roboto Condensed, uppercase, letter-spacing
- **Body**: Open Sans, line-height 1.6
- **Buttons**: Roboto Condensed, uppercase, letter-spacing 2px

### Placeholders to Replace

When implementing these templates, replace the following placeholders:

#### Reservation Confirmation Template
- `[Guest Name]` - Guest's name
- `guest@example.com` - Guest's email
- `+30 123 456 7890` - Guest's phone
- `October 20, 2025` - Check-in date
- `October 27, 2025` - Check-out date
- `2 people` - Number of guests

#### General Template
- `[Guest Name]` - Recipient's name
- Content sections can be customized for different purposes

#### Contact Response Template
- `[Guest Name]` - Contact form submitter's name
- `guest@example.com` - Submitter's email
- Message details and content

### Image Placeholders
The templates now use your actual website images:
- **Hero Background**: `https://www.wavepoint-apartments.com/assets/images/ApartmentHero.jpg`
- **Logo**: `https://www.wavepoint-apartments.com/assets/images/logo/logo.svg`

These images are loaded from your live website, ensuring consistent branding across all communications.

## Implementation Notes

### For PHP Integration
When integrating with your existing PHP reservation system:

1. **Replace placeholders** with PHP variables:
   ```php
   $guestName = $_POST['name'];
   $guestEmail = $_POST['email'];
   // etc.
   ```

2. **Update image URLs** if needed (currently using live website images):
   ```php
   $heroImage = 'https://www.wavepoint-apartments.com/assets/images/ApartmentHero.jpg';
   $logoUrl = 'https://www.wavepoint-apartments.com/assets/images/logo/logo.svg';
   ```

3. **Dynamic content**: Use PHP to populate reservation details, dates, etc.

### Email Sending
These templates work with:
- **PHP mail()** function
- **PHPMailer** library
- **SMTP** services
- **Email service providers** (SendGrid, Mailgun, etc.)

### Testing
Test templates in various email clients:
- Gmail (web, mobile app)
- Outlook (desktop, web)
- Apple Mail
- Mobile email apps

## File Structure
```
email-templates/
├── reservation-confirmation.html    # Booking confirmation email
├── general-template.html           # Generic email template  
├── contact-response.html           # Contact form auto-response
└── README.md                      # This documentation
```

## Usage Examples

### Basic PHP Implementation
```php
$emailTemplate = file_get_contents('email-templates/reservation-confirmation.html');
$emailTemplate = str_replace('[Guest Name]', $guestName, $emailTemplate);
$emailTemplate = str_replace('guest@example.com', $guestEmail, $emailTemplate);
// Continue replacing placeholders...

mail($to, $subject, $emailTemplate, $headers);
```

### With PHPMailer
```php
$mail = new PHPMailer();
$htmlContent = file_get_contents('email-templates/reservation-confirmation.html');
// Replace placeholders...
$mail->Body = $htmlContent;
$mail->isHTML(true);
```

## Browser Support
- Modern browsers (Chrome, Firefox, Safari, Edge)
- Email clients (Gmail, Outlook, Apple Mail, etc.)
- Mobile email applications

## License
These templates are part of the Wave Point Apartment project and follow the same licensing as the main website.