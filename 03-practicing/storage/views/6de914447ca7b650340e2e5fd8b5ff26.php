<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function changeLanguage(lang) {
    $.ajax({
      url: "<?php echo url('/set_language'); ?>",  
      type: "POST",
      data: { lang: lang },
      success: function(response) {
        if (lang === 'ar') {
          document.documentElement.setAttribute('lang', 'ar');
          document.documentElement.setAttribute('dir', 'rtl');
        } else {
          document.documentElement.setAttribute('lang', 'en');
          document.documentElement.setAttribute('dir', 'ltr');
        }
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

