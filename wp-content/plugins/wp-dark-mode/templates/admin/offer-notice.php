<p>Get hyped with super bowl super sale and enjoy up to 85% OFF on <strong>WP Dark Mode</strong>. <a class="button button-primary" href="https://wppool.dev/wp-dark-mode" target="_blank">Get Now!</a>
</p>

<script>
    (function ($) {
        $(document).on('click', '.offer_notice .notice-dismiss', function () {


            wp.ajax.send('hide_offer_notice', {
                success: function (res) {
                    console.log(res);
                },

                error: function (error) {
                    console.log(error);
                },
            });
        })
    })(jQuery)
</script>