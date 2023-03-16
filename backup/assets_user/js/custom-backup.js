$(document).ready(function(){
  customScript.init({
  });
});

var self;
var customScript = {
  init: function(settings){
    this.settings = settings;
    self = this;
        
    this.utilities();
    this.nav_menu();
    this.search_form();
    this.work_slider();
    this.pro_slider();
    this.touchspin();
  },
  nav_menu: function() {
    if($(window).width() >= 767) {
      $('#menu-toggle').hover(function() {
          $(this).toggleClass('active');
          $('.navigation').addClass('active');
      });
      $('.navigation').hover(function() {
          $(this).addClass('active');
      });
      $('#menu-toggle').mouseleave(function() {
          $(this).removeClass('active');
          $('.navigation').removeClass('active');
      });
      $('.navigation').mouseleave(function() {
          $(this).removeClass('active');
          $('#menu-toggle').removeClass('active');
      });
    }
    if ($(window).width() <= 767) {
        $('#menu-toggle').click(function() {
            $(this).toggleClass("active");
            $('.navigation').toggleClass("active");
        });
    }
  },
  search_form: function() {
    $(".search-icon").click(function() {
        $(this).next().slideToggle(150);
        setTimeout(function() {
            $('.search-form input.form-control').focus();
        }, 200);
    });
  },
  work_slider: function() {
    $(".work-slider").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      infinite: true,
      dots: false
    });
  },
  pro_slider: function() {
    $(".pro-slider .main-img").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      asNavFor: '.pro-slider .thumb-img',
      dots: false,
      adaptiveHeight: true
    });
    $(".pro-slider .thumb-img").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      asNavFor: '.pro-slider .main-img',
      dots: false,
      focusOnSelect: true,
      arrows: false,
      responsive: [
        {
          breakpoint: 577,
          settings: {
            slidesToShow: 2
          }
        }
      ]
    });
  },
  utilities: function(){

    $(".account-dropdown > a").on("click", function (e) {
      e.preventDefault();
      $(this).parent().find("ul").slideToggle();
    });

    $(".custom-dropdown .toggler").on("click", function(e){
      e.preventDefault();
      if($(window).width() <= 767) {
        $(this).parent().find(".nav-tabs").slideToggle();

        $(".nav-tabs li a").on("click", function(){
          var tab_html = $(this).html();
          $(".toggler").html(tab_html);
          $(".nav-tabs").slideUp();          
        });
      }
    });

    $(".selectpicker").selectpicker();

    $(".bundl-slider").slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      dots: false,
      centerMode: true,
      variableWidth: true
    });

    $(".dashboard-dropdown .toggler").on("click", function(e){
      e.preventDefault();
      if($(window).width() <= 767) {
        $(this).parent().find(".dashboard-links").slideToggle();
      }
    });

    $(".range-slider").on("change", function(){
      var slider_value = $(this).val();
      if($(this).val() < 30) {
        $(this).parent().find(".label-left").addClass("active");
        $(this).parent().find(".label-right").removeClass("active")
      }
      else if($(this).val() > 70) {
        $(this).parent().find(".label-right").addClass("active");
        $(this).parent().find(".label-left").removeClass("active");
      }
      else if($(this).val() > 40 && $(this).val() < 60) {
        $(this).parent().find(".label-center").addClass("active");
        $(this).parent().find(".label-right").removeClass("active");
        $(this).parent().find(".label-left").removeClass("active");
      }
      else {
       $(this).parent().find(".active").removeClass("active"); 
      }
    });

    
    $(window).scroll( function(){
      $(".section-title").each(function(){
      var bottom_of_object = $(this).offset().top - 400;
      var bottom_of_window = $(window).scrollTop();
        if( bottom_of_window >= bottom_of_object ){
            $(this).addClass("active");
        }
        else {
         $(this).removeClass("active"); 
        }
      });
    });

    $(".navigation-links .inner > li > a").on("click", function(e){
        e.preventDefault();
        $(".navigation-links .inner").find(".active").removeClass("active");
        $(this).addClass("active");
        var  data_id = $(this).attr("href");
        $("html, body").animate({ scrollTop: $(data_id).offset().top }, 1000);
    });

    $(window).on("scroll", function(){

    });

    $(".file-icon input").on('change', function (event) {
      var pre_val = $(this).val();
      //console.log(pre_val);
      var countFiles = $(this)[0].files.length;
      var image_holder = $(this).parents(".uploader-wrapper").find(".files-holder");
      image_holder.empty();
      if (typeof (FileReader) != "undefined") {
        for (var i = 0; i < countFiles; i++) {
          var fileType = $(this)[0].files[i].type;
          var extn = fileType.substring(fileType.lastIndexOf('/') + 1).toLowerCase();
          var li;
          alert(extn);
          switch(extn) {
            case "gif":
            case "png":
            case "jpg":
            case "jpeg":
              var reader = new FileReader();
              reader.onload = function (e) {
                var src = e.target.result;
                li = "<li class='selected'><a href='#' class='remove-img'></a><img class='thumb-image' src='"+src+"' /></li>";
                image_holder.append(li);
              }
              reader.readAsDataURL($(this)[0].files[i]);
              break;
            
            case "pdf":
              li = "<li class='selected'><a href='#' class='remove-img'></a><img class='thumb-image' src='assets_user/images/file-icons/pdf-icon.png' /></li>";
              image_holder.append(li);
              break;

            case "psd":
              li = "<li class='selected'><a href='#' class='remove-img'></a><img class='thumb-image' src='assets_user/images/file-icons/psd-icon.png' /></li>";
              image_holder.append(li);
              break;

            case "ai":
              li = "<li class='selected'><a href='#' class='remove-img'></a><img class='thumb-image' src='assets_user/images/file-icons/ai-icon.png' /></li>";
              image_holder.append(li);
              break;

            case "doc":
            case "docx":
              li = "<li class='selected'><a href='#' class='remove-img'></a><img class='thumb-image' src='assets_user/images/file-icons/docx-icon.png' /></li>";
              image_holder.append(li);
              break;

            case "ppt":
            case "pptx":
              li = "<li class='selected'><a href='#' class='remove-img'></a><img class='thumb-image' src='assets_user/images/file-icons/pptx-icon.png' /></li>";
              image_holder.append(li);
              break;

            case "xls":
            case "xlsx":
              li = "<li class='selected'><a href='#' class='remove-img'></a><img class='thumb-image' src='assets_user/images/file-icons/xlsx-icon.png' /></li>";
              image_holder.append(li);
              break;

            case "eps":
              li = "<li class='selected'><a href='#' class='remove-img'></a><img class='thumb-image' src='assets_user/images/file-icons/eps-icon.png' /></li>";
              image_holder.append(li);
              break;

            case "indd":
              li = "<li class='selected'><a href='#' class='remove-img'></a><img class='thumb-image' src='assets_user/images/file-icons/id-icon.png' /></li>";
              image_holder.append(li);
              break;

            default:
              li = "<li class='selected'><a href='#' class='remove-img'></a><img class='thumb-image' src='assets_user/images/file-icons/text-icon.png' /></li>";
              image_holder.append(li);
          } 
        }
      } else {
        alert("Pls select correct format");
      } 
      
      $(document).on("click", ".remove-img", function(e) {
        e.preventDefault();
        $(this).parent().remove();
      });
    });

    $(window).scroll(function () {
        var position = $(this).scrollTop();
        $('.link-right').each(function () {
            var target = $(this).offset().top - 100;
            var id = $(this).attr('id');
            //console.log(id);

            if (position >= target) {
              var elem = $('.navigation-links a[href="#' + id + '"] ');
              elem.parents().find(".current").removeClass("current");
              elem.addClass("current");
              elem.removeClass("disable");
              var elem_position = $(".current").position(); 
              // var elem_position_top = elem_position.top - 50;
              // $(".navigation-wrapper").css("top", "-"+elem_position_top+"px");
            }
        });
    });


    $(".select-btns input").on("change", function(){
      var input_id = $(this).attr("data-id");
      if($(this).attr("checked", "true")) {
        $("#"+input_id).toggleClass("active");
      }
    });

    $(".show-register").on("click", function(e) {
      e.preventDefault();
      $(this).addClass("disabled");
      $(".register").fadeIn();
    });

    $('#login-modal').on('hidden.bs.modal', function () {
      $(".show-register").removeClass("disabled");
      $(".register").fadeOut();
  });

  },
  touchspin: function(){
    $(".touchspin").TouchSpin({
      min: 1,
      max: 1000
    });

    $('.page_dec_btn').click(function(event){
      event.preventDefault();
      //alert('run');
      var e = $(this).closest('.plus-minus-input').find('input.page_range');
      var pre_val = e.data('preval');
      if(pre_val > 0){
        if(pre_val == 1){
          var next_val = 0;
        }else{
          var next_val = parseInt(pre_val)-1;
        }
      }else{
        return false;
      }

      if(next_val == 0){
        var next_range = "1 - 10"; 
        $(this).parent().find('input').removeClass('green-color');
      }else{
        var next_range = parseInt(next_val)*10+" - "+(parseInt(next_val)*10+10);
        $(this).parent().find('input').addClass('green-color');
      }

      //console.log("preval",preval);
      //console.log("next_val", next_val);
      //console.log("next_range", next_range);

      /*$('.total_price').text(numeral(data.total).format('0,0[.]00')+' SAR');
      $('input[name="total_price"]').val(data.total);

      $('.total_time').text(new_total_time);
      $('input[name="total_time"]').val(new_total_time);*/
      

      e.data('preval',next_val);
      var val = e.val();
      e.val(next_range);
    });

    $('.page_inc_btn').click(function(e){
      e.preventDefault();

      //alert('run');

      var preval = $(this).closest('.plus-minus-input').find('input.page_range').data('preval');
      
      var next_val = parseInt(preval)+1;

      $(this).closest('.plus-minus-input').find('input.page_range').data('preval',next_val);

      var val = $(this).closest('.plus-minus-input').find('input.page_range').val();

      var next_range = parseInt(next_val)*10+" - "+(parseInt(next_val)*10+10);

      $(this).closest('.plus-minus-input').find('input.page_range').val(next_range);

      if(next_val > 0){
        $(this).parent().find('input').addClass('green-color');
      }else{
        $(this).parent().find('input').removeClass('green-color');
      }

    });

    $(document).on("click", ".add-cart", function() {
      var eml = $(this);
      eml.parents("tr").find(".statics.brand").addClass("change-color");
      setTimeout(function(){
        eml.parents("tr").find(".change-color").removeClass("change-color");
      }, 1200);
    });

    $(".bootstrap-touchspin .btn-primary").on("click", function() {
      var text = $(this).parents(".bootstrap-touchspin").find(".form-control").val();
      //console.log(text);
      $(this).parents("tr").find(".show-on-quantity").removeClass("show-on-quantity");
      if(text == "1") {
        $(this).parents("tr").find(".statics").addClass("show-on-quantity");
      }
    });
  }
}