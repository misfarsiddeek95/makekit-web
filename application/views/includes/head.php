<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php
    switch ($activePage) {
        case 'HOME':
            $title = 'Makekit';
            break;
        case 'CLASS':
            $title = 'תכניות חוגים – Makekit';
            break;
        case 'WHOLESALE':
            $title = 'מוצרים בסיטונאות – Makekit';
            break;
        case 'DRAWINGS':
            $title = 'ציורים להדפסה – Makekit';
            break;
        case 'CONTACT':
            $title = 'צרו קשר – Makekit';
            break;
        default:
            $title = 'Makekit';
            break;
    }
?>

<title><?=($pageMain && $pageMain->seo_title) ? $pageMain->seo_title : $title?></title>
<meta name="description" content="<?=($pageMain && $pageMain->seo_description) ? $pageMain->seo_description : '' ?>">
<meta name="keywords" content="<?=($pageMain && $pageMain->seo_keywords) ? $pageMain->seo_keywords : '' ?>">

<!-- Standard Favicon -->
<link rel="icon" type="image/x-icon" href="<?=base_url()?>assets/images/favicon.ico">

<!-- PNG Favicons -->
<link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>assets/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>assets/images/favicon-16x16.png">

<!-- Apple Touch Icon (for iOS devices) -->
<link rel="apple-touch-icon" sizes="180x180" href="<?=base_url()?>assets/images/apple-touch-icon.png">

<!-- Android / PWA Icons -->
<link rel="icon" type="image/png" sizes="192x192" href="<?=base_url()?>assets/images/android-chrome-192x192.png">
<link rel="icon" type="image/png" sizes="512x512" href="<?=base_url()?>assets/images/android-chrome-512x512.png">


<!-- Bootstrap 5.3 CSS for layout and toggler functionality -->
<link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome for Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<!-- Google Fonts - Assistant -->
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/styles.css">