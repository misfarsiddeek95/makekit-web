<!DOCTYPE html>
<!-- Specifying Hebrew language and Right-to-Left direction for proper layout -->
<html lang="he" dir="rtl">
<head>
    <?php $this->load->view('includes/head'); ?>
</head>
<body>

    <?php $this->load->view('includes/header'); ?>

    <main>
        <!-- Slider section -->
        <section class="banner-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h1>תכניות חוגים</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Middle section -->
        <section class="class-list my-5 py-4">
            <div class="container">
                <div class="d-flex flex-md-row flex-column align-items-center my-5">
                    <div class="col-lg-6 right-image-col mt-lg-0">
                        <img 
                            fetchpriority="high" 
                            decoding="async" 
                            width="630" 
                            height="630" 
                            class="img-fluid main-image" 
                            src="https://makesmart.co.il/wp-content/uploads/2023/09/class-1.jpg" 
                            alt="" 
                            title="class-1" 
                            srcset="https://makesmart.co.il/wp-content/uploads/2023/09/class-1.jpg 630w, https://makesmart.co.il/wp-content/uploads/2023/09/class-1-300x300.jpg 300w, https://makesmart.co.il/wp-content/uploads/2023/09/class-1-150x150.jpg 150w, https://makesmart.co.il/wp-content/uploads/2023/09/class-1-600x600.jpg 600w, https://makesmart.co.il/wp-content/uploads/2023/09/class-1-100x100.jpg 100w" 
                            sizes="(max-width: 630px) 100vw, 630px"
                        >
                    </div>
                    <div class="col-lg-6 text-col">
                        <h1 class="underline-heading-1">אלקטרוניכיף</h1>
                        <div class="container-underline"></div>
                        <p>חוג זה המתקיים ללא מלחם, לבטיחות מירבית, פותח והותאם במיוחד לגילאים צעירים.</p>
                        <p>את החוג ילוו בורי המברג ואלי האלקטרון בסיפורים המשלבים בין עולם הדמיון של הילדים, בין ערכים חינוכיים ובין תחום האלקטרוניקה.</p>
                        <p>במסגרת החוג, התלמידים ילמדו חוקים בסיסיים בחשמל, יקראו שרטוטים, יחשבו ערכים של רכיבים, יכירו מושגים שונים ויבנו פרויקטים מגניבים.</p>
                        <p>התלמידים יבצעו ניסויים על הפרויקטים ובסיום כל פרויקט יקחו אותו לבית.</p>
                    </div>
                </div>
                <div class="d-flex flex-md-row flex-column-reverse align-items-center my-5">
                    <div class="col-lg-6 text-col">
                        <h1 class="underline-heading-1">רובוטרוניק</h1>
                        <div class="container-underline"></div>
                        <p>חוג זה המתקיים ללא מלחם, לבטיחות מירבית, פותח והותאם במיוחד לגילאים צעירים.</p>
                        <p>את החוג ילוו בורי המברג ואלי האלקטרון בסיפורים המשלבים בין עולם הדמיון <br>של הילדים, בין ערכים חינוכיים ובין תחום האלקטרוניקה.</p>
                        <p>במסגרת החוג, התלמידים ילמדו חוקים בסיסיים בחשמל, יקראו שרטוטים, יחשבו ערכים של רכיבים, יכירו מושגים שונים ויבנו פרויקטים מגניבים.</p>
                        <p>התלמידים יבצעו ניסויים על הפרויקטים ובסיום כל פרויקט יקחו אותו לבית.</p>
                    </div>
                    <div class="col-lg-6 left-image-col mt-lg-0">
                        <img 
                            decoding="async" 
                            width="1200" height="1200" 
                            class="img-fluid main-image" 
                            src="https://makesmart.co.il/wp-content/uploads/2023/09/class-2.jpg" 
                            alt="" 
                            title="class-2" 
                            srcset="https://makesmart.co.il/wp-content/uploads/2023/09/class-2.jpg 1200w, https://makesmart.co.il/wp-content/uploads/2023/09/class-2-300x300.jpg 300w, https://makesmart.co.il/wp-content/uploads/2023/09/class-2-1024x1024.jpg 1024w, https://makesmart.co.il/wp-content/uploads/2023/09/class-2-150x150.jpg 150w, https://makesmart.co.il/wp-content/uploads/2023/09/class-2-768x768.jpg 768w, https://makesmart.co.il/wp-content/uploads/2023/09/class-2-600x600.jpg 600w, https://makesmart.co.il/wp-content/uploads/2023/09/class-2-100x100.jpg 100w" 
                            sizes="(max-width: 1200px) 100vw, 1200px"
                        >
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php $this->load->view('includes/footer') ?>

    <?php $this->load->view('includes/js') ?>
    
</body>
</html>
