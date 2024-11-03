<?php view('layout.header'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>
                <?php http_response_code(404); ?>
                Page not found
            </h1>
            <img src="<?php echo url('assets/download.png'); ?>">
        </div>
    </div>
</div>

<?php view('layout.footer'); ?>
