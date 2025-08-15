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
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>תאריך</th>
                                            <th>מספר שאלון</th>
                                            <th>נסיונות שנותרו</th>
                                            <th>תשובות נכונות</th>
                                            <th>כניסה לשאלון</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($questionaires as $que) { ?>
                                        <tr>
                                            <td><?=date('d/m/Y', strtotime($que->created_at))?></td>
                                            <td><?=$que->paper_id?></td>
                                            <td><?=$que->no_of_attempts?> / <?=$que->remaining_attempts?></td>
                                            <td><?=$que->correct_answers_last_attempt?></td>
                                            <td><a href="<?=base_url()?>my-account/questionnaires?formId=<?=base64_encode($que->paper_id)?>"><?=$que->paper_title?></a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <p>סה"כ שאלונים שבוצעו: <?=$summary['total_completed']?></p>
                                <p>סה"כ תשובות נכונות: <?=$summary['total_correct']?></p>
                                <p>מספר נקודות שנשארו: <?=$summary['remaining_points']?></p>
                                <a href="<?=base_url()?>product-category/award/">לרכישת פרסים</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>
        <?php $this->load->view('includes/js') ?>
    </body>
</html>
