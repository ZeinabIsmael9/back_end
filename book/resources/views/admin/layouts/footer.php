</main>
</div>
</div>
<script src="<?php echo url('/assets/admin/assets/dist/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    function changeLanguage(lang) {
        $.ajax({
            url: "<?php echo url(ADMIN . '/set_lang'); ?>",
            type: "POST",
            data: {
                lang: lang
            },
            success: function(response) {
                location.reload();
            },
            error: function() {
                alert("Error changing language");
            }
        });
    }
</script>
</body>

</html>
<?php
end_errors();
?>