<!DOCTYPE html>
<!-- Specifying Hebrew language and Right-to-Left direction for proper layout -->
<html lang="he" dir="rtl">
    <head>
        <?php $this->load->view('includes/head'); ?>
        <style>
            #mainImage {
                transition: opacity 0.3s ease-in-out;
            }

            img#mainImage {
                width: 100%;
                height: auto;
                max-height: none; /* or increase max-height */
                object-fit: contain; /* keep aspect ratio */
            }

            /* Remove number input spinners */
            input[type=number]::-webkit-inner-spin-button,
            input[type=number]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            input[type=number] {
                -moz-appearance: textfield;
                appearance: textfield;
            }

            /* Remove hover effect */
            .btn-no-hover:hover {
                background-color: inherit;
                border-color: inherit;
                color: inherit;
            }

            /* Optional: ensure uniform button height and no rounding */
            .qty-btn,
            #qtyInput {
                border-radius: 0 !important;
                height: 42px;
                border: 1px solid rgba(0,0,0,.1)
            }
            .qty-btn:hover {
                border: 1px solid rgba(0,0,0,.1)
            } 
        </style>

    </head>
    <body>
        <?php $this->load->view('includes/header'); ?>
        <main>
            <!-- Slider section -->
            <section class="banner-section">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <h1>Azaqod</h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Product section -->
            <section class="product-detail py-5 px-5">
                <div class="container">
                    <hr/>
                    <div class="text-end mb-4">
                        <nav aria-label="Breadcrumb" class="breadcrumb">
                            <a href="<?=base_url()?>">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">עמוד הבית</font>
                                </font>
                            </a>
                            <a href="<?=base_url()?>">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">&nbsp;/ עמוד הבית</font>
                                </font>
                            </a>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;"> &nbsp;/ Azakod</font>
                            </font>
                        </nav>
                    </div>
                    <hr/>
                    
                    <div class="d-flex flex-column flex-column-reverse flex-md-row flex-md-row-reverse justify-content-between gap-3">
                        <div class="col-12 col-md-6">
                            <p class="price">
                                <span class="amount">
                                    <bdi><span class="currency-symbol">₪</span>24.00</bdi>
                                </span>
                            </p>

                            <div class="short-description">
                                <p>
                                    אזעקה קטנה, רב שימושית ופשוטה לתפעול.<br>
                                    האזעקה מתחברת לכל דלת\חלון.<br>
                                    האזעקה מתריעה בעוצמה במקרים בהם הדלת\חלון נפתח\ת ללא אישור.<br>
                                    לתפעול האזעקה יש ללחוץ על הלחצן בצד ולהניח את האזעקה על דלת\חלון, באופן כזה שהלחצן ישאר באותו מצב.
                                </p>
                            </div>

                            <table class="table table-responsive table-bordered my-4">
                                <thead>
                                    <tr>
                                        <th>כמות</th>
                                        <th>הנחה</th>
                                        <th>מחיר יחידה</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>10-24</td>
                                        <td>4%</td>
                                        <td>₪23.04</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <!-- Quantity Input with +/- -->
                                <div class="input-group" style="width: 130px;">
                                    <button class="btn btn-outline-secondary btn-no-hover qty-btn" type="button" onclick="decreaseQty()">−</button>
                                    <input type="number" id="qtyInput" class="form-control text-center" value="1" min="1" max="99">
                                    <button class="btn btn-outline-secondary btn-no-hover qty-btn" type="button" onclick="increaseQty()">+</button>
                                </div>

                                <!-- Add to Cart Button -->
                                <button class="btn d-block curved-button btn-add-to-cart" onclick="addToCart()">הוספה לסל</button>
                            </div>

                            <hr/>
                            
                            <div class="my-3 category-preview">
                                <p>קטגוריה: <a href="">Robotronic</a></p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex justify-content-md-start">
                            <div class="product-image-wrapper text-center">

                                <!-- Main Image with Zoom Icon -->
                                <div class="position-relative d-inline-block">
                                    <img id="mainImage" src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28-main.png" class="img-fluid border rounded" alt="Product" />
                                
                                    <button class="btn btn-light rounded-pill position-absolute top-0 start-0 m-2 bg-white" style="transform: scaleX(-1);" data-bs-toggle="modal" data-bs-target="#zoomModal" title="Zoom">
                                    🔍
                                    </button>
                                </div>

                                <!-- Thumbnails -->
                                <div class="mt-3 d-flex flex-wrap justify-content-start gap-2">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28-main.png" class="thumb-img img-thumbnail" style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;" onclick="setMainImage(this, 0)">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28.png" class="thumb-img img-thumbnail" style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;" onclick="setMainImage(this, 1)">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-8.png" class="thumb-img img-thumbnail" style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;" onclick="setMainImage(this, 2)">
                                </div>
                            </div>

                            <div class="modal fade" id="zoomModal" tabindex="-1" aria-labelledby="zoomModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-fullscreen modal-lg">
                                    <div class="modal-content bg-dark border-0">
                                        <div class="modal-header justify-content-end">
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <div id="carouselZoom" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28-main.png" class="d-block w-100 img-fluid" style="max-height: 90vh; object-fit: contain;" alt="Zoom Image 1">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28.png" class="d-block w-100 img-fluid" style="max-height: 90vh; object-fit: contain;" alt="Zoom Image 2">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-8.png" class="d-block w-100 img-fluid" style="max-height: 90vh; object-fit: contain;" alt="Zoom Image 3">
                                                    </div>
                                                </div>

                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselZoom" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselZoom" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="related-product-section py-5 px-5">
                <div class="container px-0">
                    <div class="text-end mb-4">
                        <div class="section-title-container">
                            <h1 class="underline-heading-1">מוצרים קשורים</h1>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Product 1 -->
                        <div class="col-6 col-lg-3 mb-4 text-center products">
                            <a href="#">
                                <div class="card product-card">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28.png" alt="Product Image 1" class="product-img img-main">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28-main.png" alt="Product Image 1 Hover" class="product-img img-hover">
                                </div>
                                <h2>מורס נסיון</h2>
                                <span class="price">החל מ: ₪0.00</span>
                            </a>
                            <button class="btn d-block curved-button btn-add-to-cart">הוספה לסל</button>
                        </div>

                        <div class="col-6 col-lg-3 mb-4 text-center products">
                            <a href="#">
                                <div class="card product-card">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28.png" alt="Product Image 1" class="product-img img-main">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28-main.png" alt="Product Image 1 Hover" class="product-img img-hover">
                                </div>
                                <h2>מורס נסיון</h2>
                                <span class="price">החל מ: ₪0.00</span>
                            </a>
                            <button class="btn d-block curved-button btn-add-to-cart">הוספה לסל</button>
                        </div>

                        <div class="col-6 col-lg-3 mb-4 text-center products">
                            <a href="#">
                                <div class="card product-card">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28.png" alt="Product Image 1" class="product-img img-main">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28-main.png" alt="Product Image 1 Hover" class="product-img img-hover">
                                </div>
                                <h2>מורס נסיון</h2>
                                <span class="price">החל מ: ₪0.00</span>
                            </a>
                            <button class="btn d-block curved-button btn-add-to-cart">הוספה לסל</button>
                        </div>

                        <div class="col-6 col-lg-3 mb-4 text-center products">
                            <a href="#">
                                <div class="card product-card">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28.png" alt="Product Image 1" class="product-img img-main">
                                    <img src="https://makesmart.co.il/wp-content/uploads/2024/05/harkava-28-main.png" alt="Product Image 1 Hover" class="product-img img-hover">
                                </div>
                                <h2>מורס נסיון</h2>
                                <span class="price">החל מ: ₪0.00</span>
                            </a>
                            <button class="btn d-block curved-button btn-add-to-cart">הוספה לסל</button>
                        </div>

                    </div>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        <script>
            function setMainImage(el, index) {
                const mainImage = document.getElementById('mainImage');

                // Fade out
                mainImage.style.opacity = 0;

                setTimeout(() => {
                mainImage.src = el.src; // change the image
                mainImage.style.opacity = 1; // fade in
                }, 150);
            }

            const imgContainer = document.querySelector('.product-detail .position-relative');
            const mImage = imgContainer.querySelector('img');

            imgContainer.addEventListener('mousemove', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left; // x position within the container
                const y = e.clientY - rect.top;  // y position within the container
                
                const xPercent = (x / rect.width) * 100;
                const yPercent = (y / rect.height) * 100;
                
                mImage.style.transformOrigin = `${xPercent}% ${yPercent}%`;
                mImage.style.transform = 'scale(2)';  // zoom scale
            });

            imgContainer.addEventListener('mouseleave', function() {
                mImage.style.transformOrigin = 'center center';
                mImage.style.transform = 'scale(1)';
            });

            function decreaseQty() {
                const input = document.getElementById('qtyInput');
                let value = parseInt(input.value);
                if (value > 1) {
                    input.value = value - 1;
                }
            }

            function increaseQty() {
                const input = document.getElementById('qtyInput');
                let value = parseInt(input.value);
                input.value = value + 1;
            }

            function addToCart() {
                const quantity = document.getElementById('qtyInput').value;
                // You can perform your AJAX or form submission here
                alert('Added ' + quantity + ' item(s) to the cart!');
            }

        </script>

    </body>
</html>
