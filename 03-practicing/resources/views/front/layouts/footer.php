</main>

<footer class="py-5 text-center text-body-secondary bg-body-tertiary">
      <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p class="mb-0">
        <a href="#">Back to top</a>
      </p>
    </footer>

    <script src="{{url('assets/front')}}/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      function changeLanguage(lang) {
        $.ajax({
          url: "<?php echo url('/set_language'); ?>",  
          type: "POST",
          data: { lang: lang },
          success: function(response) {
            // Update the HTML lang and dir attributes
            document.documentElement.setAttribute('lang', lang);
            document.documentElement.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');
            location.reload(); // Reload the page to apply the changes
          },
          error: function() {
            alert("Error changing language");
          }
        });
      }
    </script>
  </body>
</html>