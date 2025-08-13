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
                            <?php if (!empty($paper_detail['mcq_ques_ans'])) { ?>
                            <form>
                                <div class="row m-x-30 m-b-20 text-center">
                                    <div class="col-md-12">
                                        <?=$paper_detail['mcq_main_title']?>
                                    </div>
                                </div>

                                <?php 
                                    foreach ($paper_detail['mcq_ques_ans'] as $mcqIndex => $mcqs) {
                                        $mcqQueImage = '';
                                        if ($mcqs->queHasImg == 1) {
                                            $mcqQueImage = '<div class="col-12 col-md-4">
                                                                <img src="'.PHOTO_DOMAIN.'questionaire/'.$mcqs->questionImage.'"
                                                                    alt="Question image"
                                                                    class="img-thumbnail rounded"
                                                                    width="150"
                                                                    height="150"
                                                                    >
                                                            </div>';
                                        }
                                ?>
                                <div class="card mb-4 border-0">
                                    <div class="card-body">
                                        <div class="row g-3 align-items-start">
                                            <p id="q1-label" class="mb-3 fs-5"><?=$mcqIndex+1?>) <?=$mcqs->question?></p>
                                            <!-- Image column (shows only when you include an image here) -->
                                            <?=$mcqQueImage?>

                                            <!-- Text + answers -->
                                            <div class="col-12 col-md-8">

                                                <!-- answers: 1 column on xs, 2 columns on md+ -->
                                                <div class="row row-cols-1 row-cols-md-2 g-2" role="radiogroup" aria-labelledby="q1-label">
                                                    <?php 
                                                        foreach ($mcqs->answers as $ansIndex => $ans) {
                                                            $mcqAnsImage = '';
                                                            if ($ans->answerImage != '' && $ans->answerImage != null) {
                                                                $mcqAnsImage = '<img src="'.PHOTO_DOMAIN.'questionaire/'.$ans->answerImage.'"
                                                                                    alt="answer image"
                                                                                    class="img-thumbnail ms-3"
                                                                                    width="96" height="64">';
                                                            }
                                                    ?>

                                                    <div class="col">
                                                        <label class="list-group-item d-flex align-items-center">
                                                            <input class="form-check-input me-3" type="radio" name="q[<?=$mcqIndex?>]" value="2">
                                                            <div class="flex-grow-1 mx-2"><?=$ans->answer?></div>
                                                            <!-- thumbnail using plain HTML width/height attributes -->
                                                            <?=$mcqAnsImage?>
                                                        </label>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                                <!-- Submit -->
                                <div class="text-end mb-5">
                                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                </div>

                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        
    </body>
</html>
