</div>
</div>
<script src="{{url('/assets/admin')}}/assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function changeLanguage(lang) {
        $.ajax({
            url: "<?php echo url(ADMIN . '/set_lang'); ?>",  
            type: "POST",
            data: {lang: lang},
            success: function (response) {
                location.reload(); 
            },
            error: function () {
                alert("Error changing language");
            }
        });
    }
</script>
</body>
</html>
