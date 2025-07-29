# MakeKit Web Application

A modern, responsive web application built with CodeIgniter 3 framework for MakeKit, an educational technology company specializing in unique, high-quality, and educational kits for children. The application is designed with Hebrew language support and Right-to-Left (RTL) layout.

## 🚀 Project Overview

MakeKit offers educational kits suitable for workshops, birthday parties, and self-construction activities. The web application serves as the company's primary online presence, showcasing their products, services, and educational programs.

## 🛠️ Technology Stack

### Backend
- **Framework**: CodeIgniter 3.1.13
- **PHP Version**: >= 5.3.7
- **Database**: MySQL (via mysqli driver)
- **Email**: PHPMailer 6.9 for SMTP email functionality

### Frontend
- **CSS Framework**: Bootstrap 5.3
- **Icons**: Font Awesome 6.4.0
- **Fonts**: Google Fonts (Assistant)
- **JavaScript**: Custom scripts + Bootstrap Bundle

### Key Features
- **RTL Support**: Hebrew language with Right-to-Left layout
- **Responsive Design**: Mobile-first approach
- **Email Integration**: Contact forms with reCAPTCHA verification
- **Dynamic Content**: CMS-driven content management
- **File Upload**: Document handling for inquiries

## 📁 Project Structure

```
makekit-web/
├── application/                 # CodeIgniter application folder
│   ├── config/                 # Configuration files
│   │   ├── config.php         # Main configuration
│   │   ├── database.php       # Database settings
│   │   ├── routes.php         # URL routing
│   │   └── constants.php      # Application constants
│   ├── controllers/           # Application controllers
│   │   └── FrontController.php # Main frontend controller
│   ├── models/                # Data models
│   │   └── Front_model.php    # Main data model
│   ├── views/                 # View templates
│   │   ├── includes/          # Reusable view components
│   │   ├── index.php          # Homepage
│   │   ├── about.php          # About page
│   │   ├── services.php       # Services page
│   │   ├── products.php       # Products page
│   │   ├── contact.php        # Contact page
│   │   └── ...                # Other pages
│   └── core/                  # Custom core classes
├── assets/                    # Static assets
│   ├── css/                   # Stylesheets
│   ├── js/                    # JavaScript files
│   ├── images/                # Images and media
│   ├── fonts/                 # Font files
│   └── mail/                  # Email templates
├── system/                    # CodeIgniter system files
└── index.php                  # Application entry point
```

## 🎯 Key Features

### 1. Multi-language Support
- Hebrew language with RTL layout
- Proper text direction and layout handling
- Localized content management

### 2. Content Management
- Dynamic page content loading from database
- Modular content sections
- Image and media management
- SEO-friendly URLs

### 3. User Interaction
- Contact forms with validation
- Email subscription system
- Quote request functionality
- Product demo requests
- reCAPTCHA integration for security

### 4. Product Showcase
- Product catalog with detailed views
- Portfolio/works gallery
- Service listings with detailed pages
- Image galleries and media management

### 5. Email System
- SMTP email configuration
- HTML email templates
- Auto-reply functionality
- Contact form processing

## 🗄️ Database Structure

The application uses several key database tables:

- **pages**: Dynamic content management
- **web_services**: Service listings
- **web_products**: Product catalog
- **web_works**: Portfolio items
- **web_testimonials**: Customer testimonials
- **web_inquiries**: Contact form submissions
- **mail_subscriptions**: Email newsletter subscriptions
- **photo**: Media file management
- **country**: Country data for forms

## 🚀 Installation & Setup

### Prerequisites
- PHP >= 5.3.7
- MySQL/MariaDB
- Web server (Apache/Nginx)
- Composer (for dependencies)

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone [repository-url]
   cd makekit-web
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Database setup**
   - Create a MySQL database named `makekit_db`
   - Import the database schema (if available)
   - Update database credentials in `application/config/database.php`

4. **Configuration**
   - Update `base_url` in `application/config/config.php`
   - Configure email settings in `FrontController.php`
   - Set up reCAPTCHA keys if needed

5. **File permissions**
   ```bash
   chmod 755 application/cache/
   chmod 755 application/logs/
   ```

6. **Web server configuration**
   - Point document root to the project directory
   - Ensure mod_rewrite is enabled for clean URLs

### Environment Configuration

The application supports different environments:
- **Development**: Error reporting enabled
- **Production**: Error reporting disabled
- **Testing**: Custom testing environment

Set the environment via `CI_ENV` server variable or modify `index.php`.

## 📧 Email Configuration

The application uses PHPMailer for email functionality. Configure SMTP settings in `FrontController.php`:

```php
$mail->Host = 'mail.arbolsoft.com';
$mail->SMTPAuth = true;
$mail->Username = 'info@arbolsoft.com';
$mail->Password = 'your-password';
$mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
```

## 🎨 Frontend Features

### Design System
- **Color Palette**: Custom CSS variables for consistent theming
- **Typography**: Assistant font family from Google Fonts
- **Icons**: Font Awesome integration
- **Layout**: Bootstrap 5.3 grid system

### Key Components
- **Hero Section**: Carousel with call-to-action
- **Feature Icons**: Service highlights with custom styling
- **Product Cards**: Hover effects and responsive design
- **Contact Forms**: Validation and reCAPTCHA integration
- **Responsive Navigation**: Mobile-friendly menu system

## 🔧 Development

### Adding New Pages
1. Create controller method in `FrontController.php`
2. Add route in `application/config/routes.php`
3. Create view file in `application/views/`
4. Add content to database if needed

### Custom Styling
- Main stylesheet: `assets/css/styles.css`
- Bootstrap customization available
- RTL-specific styles included

### Database Operations
The application uses a custom model with helper methods:
- `get_data_with_conditions_and_joins()`: Flexible data retrieval
- `fetchPage()`: Dynamic content loading
- `insert_me()`: Data insertion

## 🔒 Security Features

- **reCAPTCHA Integration**: Form spam protection
- **Input Validation**: Server-side form validation
- **SQL Injection Prevention**: CodeIgniter's query builder
- **XSS Protection**: Output escaping
- **File Upload Security**: Secure file handling

## 📱 Responsive Design

The application is fully responsive with:
- Mobile-first approach
- Bootstrap 5.3 responsive grid
- Custom mobile navigation
- Touch-friendly interface
- Optimized images and media

## 🚀 Deployment

### Production Checklist
- [ ] Set environment to 'production'
- [ ] Configure database for production
- [ ] Update email settings
- [ ] Set up SSL certificate
- [ ] Configure web server
- [ ] Set proper file permissions
- [ ] Test all forms and functionality

### Performance Optimization
- Enable caching where appropriate
- Optimize images and assets
- Configure CDN if needed
- Monitor database performance

## 📞 Support

For technical support or questions:
- **Email**: support@makekit.co.il
- **Company**: MakeKit
- **Website**: [MakeKit Website]

## 📄 License

This project is proprietary software developed for MakeKit. All rights reserved.

---

**Note**: This application is specifically designed for Hebrew language support with RTL layout. Ensure proper Unicode support and RTL handling in your deployment environment.
