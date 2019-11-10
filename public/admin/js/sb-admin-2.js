(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

  $(document).on("change", 'input[type="file"]', function (e) {
    var fileName = e. target. files[0]. name;
    $(this).next()[0].innerText = fileName;
    // alert('The file "' + fileName + '" has been selected.' );
  });

  // function previewImage(){
  $(document).on("change", '#customFile', function (e) {
    var previewBox = document.getElementById("preview");
    previewBox.src = URL.createObjectURL(event.target.files[0]);
    // $('.bg-register-image').css('background-image','url(URL.createObjectURL(event.target.files[0]))');
  });
    
  $(document).on("click", "#eventDeleteModal", function () {
    var eventid = $(this).data('eventid');
    $("#eventidDeleteModal").val(eventid);
  });
    
  $(document).on("click", "#imageDeleteModal", function () {
    var imageid = $(this).data('imageid');
    $("#imageidDeleteModal").val(imageid);
  });
  
  $(document).on("click", "#addFormButton", function () {
    var fd = new FormData();
    var title = $("#formtitle").val();
    var src = $("#formsrc").val();
    fd.append('title', title);
    fd.append('src', src);
    fd.append('action', "add_form");
    if(title != "" && src != ""){
      $.ajax({
        url: '../../resources/controller.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
          // $("#ImagesModalBody").html(response);
          window.location.assign('index.php?forms');
        }
      }); 
    }
  });
  
  $(document).on("click", "#addImageButton", function () {
    var fd = new FormData();
    // var title = $("#addImageButton").val();
    var file = $('#addImageFile')[0].files[0];
    fd.append('file', file);
    fd.append('action', "add_image");
    if(file){
      $.ajax({
        url: '../../resources/controller.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
          // $("#ImagesModalBody").html(response);
          window.location.assign('index.php?gallary');
        }
      }); 
    }
  });

  

})(jQuery); // End of use strict
