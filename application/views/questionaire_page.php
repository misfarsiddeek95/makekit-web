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
                            
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php $this->load->view('includes/footer') ?>

        <?php $this->load->view('includes/js') ?>
        
        <script>
            $('#question_form').on('submit', function(e){
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '<?=base_url()?>save-answers',
                    data: $('#question_form').serialize(),
                    success: function(result) {
                        const resp = $.parseJSON(result);

                        if (resp.status == 'success') {
                            location.href="<?=base_url('my-account')?>";
                        }
                    },
                    error: function(result) {
                        console.error('Error : ', result)
                    }
                });
            });
        </script>
    </body>
</html>
