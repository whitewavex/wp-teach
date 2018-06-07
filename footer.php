    <footer class="footer">
        <div class="container">
            <div class="d-flex flex-row align-items-center">
                <div class="col-md-2 col-sm-3 col-3">
                    <img src="<?php bloginfo(template_url) ?>/images/logo.png" alt="" class="logo">
                </div>
                <div class="col-md-10 col-sm-9 col-9 copyright">
                    <p class="copyright__text"><i class="fa fa-copyright copyright__img" aria-hidden="true"></i> Сайт для вчителів і батьків молодших школярів. Усі права захищено. 2014 - <?php echo date('Y'); ?>.</p>
                </div>
            </div>
        </div>
        <?php $options = get_option('write_us_options'); ?>
        <a href="" class="feedback">Напишіть нам</a>
        <div id="modal-form" class="modal-form">
            <i class="fa fa-times modal-form__close" aria-hidden="true"></i>
            <h3 class="modal-form__header"><?php echo $options['option_title'] ?></h3>
            <?php echo do_shortcode($options['option_form']) ?>
        </div>
        <div class="modal-bg"></div>
    </footer>
    <script src="<?php bloginfo(template_url) ?>/libs/jquery.min.js"></script>
    <script src="<?php bloginfo(template_url) ?>/libs/bootstrap.min.js"></script>
    <script src="<?php bloginfo(template_url) ?>/libs/jquery.fancybox.min.js"></script>
    <script src="<?php bloginfo(template_url) ?>/js/main.js"></script>
    <?php wp_footer(); ?>
</body>
</html>