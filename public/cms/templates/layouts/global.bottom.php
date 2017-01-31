    </div>
  </body>

  <script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
  <script>
  // Temp: Will be replaced with vanilla JS when there is spare time!
  var visionBox = $('.vision-box');
  $('.js-vision-box__item').on('click', function(e) {
    e.preventDefault();
    $('.vision-box__item').addClass('vision-box__item--closed').removeClass('vision-box__item--open');
    $(this).addClass('vision-box__item--open').removeClass('vision-box__item--closed');
    visionBox.addClass('vision-box--active');
  });

  $('.js-vision-box__close').on('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $('.vision-box__item--open').removeClass('vision-box__item--open');
    $('.vision-box__item--closed').removeClass('vision-box__item--closed');
    visionBox.removeClass('vision-box--active');
  });

  $('.js-menu-toggle').on('click', function(e) {
    e.preventDefault();
    $('.nav-drawer').toggleClass('nav-drawer--open');
  })
  </script>

</html>
