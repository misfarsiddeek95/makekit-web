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
                            <h1><?=$pageMain->headline?></h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Wholesale item section -->
            <section class="my-account my-2 p-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <?php $this->load->view('includes/account/user_header'); ?>
                        </div>
                        <div class="col-12 col-md-9 p-4">
                            <form>
                                <div class="card mb-4 border-0">
                                    <div class="card-body">
                                        <div class="row g-3 align-items-start">
                                            <!-- Image column (shows only when you include an image here) -->
                                            <div class="col-12 col-md-4 text-center">
                                                <img src="http://localhost/make-kit/photos/products/600a279dee211149c26ab71be7824747-org.png"
                                                    alt="Question image"
                                                    class="img-fluid rounded">
                                            </div>

                                            <!-- Text + answers -->
                                            <div class="col-12 col-md-8">
                                                <p id="q1-label" class="mb-3 fs-5">
                                                הציורים צוירו ע"י צייר הבית, לביא כהן. ניתן להזמין ציורים מותאמים אישית.
                                                </p>

                                                <!-- answers: 1 column on xs, 2 columns on md+ -->
                                                <div class="row row-cols-1 row-cols-md-2 g-2" role="radiogroup" aria-labelledby="q1-label">
                                                    <div class="col">
                                                        <label class="list-group-item d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="radio" name="q1" value="1">
                                                            <div class="flex-grow-1 mx-2">תשובה אפשרית 1</div>
                                                        </label>
                                                    </div>

                                                    <div class="col">
                                                        <label class="list-group-item d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="radio" name="q1" value="2">
                                                            <div class="flex-grow-1 mx-2">תשובה אפשרית 2 עם תמונה</div>
                                                            <!-- thumbnail using plain HTML width/height attributes -->
                                                            <img src="http://localhost/make-kit/photos/products/600a279dee211149c26ab71be7824747-org.png"
                                                                alt="answer image"
                                                                class="img-thumbnail ms-3"
                                                                width="96" height="64">
                                                        </label>
                                                    </div>

                                                    <div class="col">
                                                        <label class="list-group-item d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="radio" name="q1" value="3">
                                                            <div class="flex-grow-1 mx-2">תשובה אפשרית 3</div>
                                                        </label>
                                                    </div>

                                                    <div class="col">
                                                        <label class="list-group-item d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="radio" name="q1" value="4">
                                                            <div class="flex-grow-1 mx-2">תשובה אפשרית 4</div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ========== Question WITHOUT image (full width) ========== -->
                                <div class="card mb-4 border-0">
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <p id="q2-label" class="mb-3 fs-5">זו שאלה ללא תמונה. בחר את התשובה הנכונה.</p>

                                                <div class="row row-cols-1 row-cols-md-2 g-2" role="radiogroup" aria-labelledby="q2-label">
                                                    <div class="col">
                                                        <label class="list-group-item d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="radio" name="q2" value="1">
                                                            <div class="flex-grow-1 mx-2">אפשרות 1</div>
                                                        </label>
                                                    </div>

                                                    <div class="col">
                                                        <label class="list-group-item d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="radio" name="q2" value="2">
                                                            <div class="flex-grow-1 mx-2">אפשרות 2</div>
                                                        </label>
                                                    </div>

                                                    <div class="col">
                                                        <label class="list-group-item d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="radio" name="q2" value="3">
                                                            <div class="flex-grow-1 mx-2">אפשרות 3</div>
                                                        </label>
                                                    </div>

                                                    <div class="col">
                                                        <label class="list-group-item d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="radio" name="q2" value="4">
                                                            <div class="flex-grow-1 mx-2">אפשרות 4</div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="text-end mb-5">
                                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        
    </body>
</html>
