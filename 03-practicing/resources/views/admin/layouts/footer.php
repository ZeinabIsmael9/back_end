</main>
</div>
</div>
<script src="{{url('/assets/admin')}}/assets/dist/js/bootstrap.bundle.min.js"></script>
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
<script>
$(document).ready(function(){
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    <?php if(session_has('success')):?>
    toastr.success('{{session_flash("success")}}', '{{trans("admin.success")}}');
    <?php endif;?>
});
     </script>
</body>

</html>
@php
end_errors();
@endphp