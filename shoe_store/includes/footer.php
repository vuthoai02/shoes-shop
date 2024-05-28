<footer class="bg-second">
    <div class="container">
        <div class="row center">
            <div class="col-md-6 col-sm-12">
                <div class="contact">
                    <p class="contact-header">
                        SNEAKER STORE
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- app js -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script>
    <?php if (isset($_SESSION['message'])) {
    ?>
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('<?= $_SESSION['message'] ?>');
    <?php
        unset($_SESSION['message']);
    }
    ?>
</script>