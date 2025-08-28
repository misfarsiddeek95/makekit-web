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
                        <div class="col-12 col-md-9 p-4 has-cart-button">
                        
                            <button class="btn curved-button btn-add-to-cart mb-3 w-25" id="toggle-code">התחל נייר</button>
                            
                            <div id="question-block" class="mt-3 mb-5" style="display:none;">
                                <div id="exam-alert" class="w-50"></div>
                                <div class="container-fluid">
                                    <div class="row justify-content-start">
                                        <div class="col-md-6"> <!-- 👈 half width on medium+ screens -->
                                            <div class="d-flex flex-row gap-2">
                                                <input type="text" class="form-control" id="papercode" placeholder="קוד נייר">
                                                <button class="btn curved-button btn-add-to-cart w-100" onclick="startExam();">הַתחָלָה</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if(!empty($questionaires)) { ?>
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
                                            <td><?=base64_encode($que->paper_id)?></td>
                                            <td><?=$que->no_of_attempts?> / <?=$que->remaining_attempts?></td>
                                            <td><?=$que->correct_answers_last_attempt?></td>
                                            <td><a href="<?=base_url()?>my-account/questionnaires?formId=<?=base64_encode($que->paper_id)?>&qtype=medalian"><?=$que->paper_title?></a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <p>סה"כ שאלונים שבוצעו: <?=$summary['total_completed']?></p>
                                <p>סה"כ תשובות נכונות: <?=$summary['total_correct']?></p>
                                <p>מספר נקודות שנשארו: <?=$summary['total_medalian_points']?></p>
                            </div>
                            <?php } else { ?>
                                <div class="alert alert-warning" role="alert">לא נותרו לך ניסיונות למשימה זו.</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>
        <?php $this->load->view('includes/js') ?>

        <script>
            $(document).ready(function() {
                $("#toggle-code").click(function (e) {
                    e.preventDefault(); // prevent default link behavior
                    $("#question-block").slideToggle("slow");
                });
            });

            const startExam = () => {
                const code = $('#papercode').val();
                const alertBox = $('#exam-alert'); // Your alert container

                if (code === '') {
                    alertBox.html(`
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            אנא הזן את קוד נייר הבחינה.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>start-medalian-exam",
                    data: { code },
                    success: function(result) {
                        const resp = $.parseJSON(result);
                        if (resp.status === 'success') {
                            location.href=resp.redirect_url;
                        } else {
                            alertBox.html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    ${resp.message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `);
                        }
                    },
                    error: function() {
                        alertBox.html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                אירעה שגיאה בעת החלת קוד נייר.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                    }
                });
            }
        </script>
    </body>
</html>
