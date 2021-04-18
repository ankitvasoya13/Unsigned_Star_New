<script src="<?php echo e(asset('js/jquery-3.3.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/modernizr.js')); ?>"></script>
<script src="<?php echo e(asset('js/plugin.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.nice-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.inview.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.magnific-popup.js')); ?>"></script>
<script src="<?php echo e(asset('js/swiper.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/comboTreePlugin.js')); ?>"></script>
<script src="<?php echo e(asset('js/mp3/jquery.jplayer.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/mp3/jplayer.playlist.js')); ?>"></script>
<script src="<?php echo e(asset('js/owl.carousel.js')); ?>"></script>
<script src="<?php echo e(asset('js/mp3/player.js')); ?>"></script>
<script src="<?php echo e(asset('croppie/croppie.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/custom.js')); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
$(document).ready(function(){
	$("#loginNow").click(function(){
		$("#loginForm").submit(); // Submit the form.
	});
});
$(document).ready(function(){
	  $("#genre").css("display", "block");
	  $("#country").css("display", "block");
	});
$(document).ready(function(){
	var getUrl = window.location;
	var baseUrl = getUrl.protocol + "//" + getUrl.host + "/";
	var id = "<?php echo e(Session()->get('userId')); ?>";
	var type = "<?php echo e(Session()->get('userType')); ?>";
	var token = "<?php echo e(csrf_token()); ?>";
		$.ajax({
			type: "POST",
			url: baseUrl+"getMessageNotification",
			data: {id:id,type:type, _token:token},
		success: function (data) {
      console.log(data);
			if (data > 0) {
				$("span.current.message").addClass('budge_noti');	
			} else {
				$("span.current.message").removeClass('budge_noti');	
			}
		}
	});
});


  var getUrl = window.location;
  var baseUrl = getUrl.protocol + "//" + getUrl.host + "/";
    //console.log("url=", getUrl);
    //console.log("base url=", baseUrl);
  if (getUrl != baseUrl){
    //searchArtist(8);
  }
  $(document).on("keyup", "#artistSearchText", function(e) {
    e.preventDefault();    
    if (e.which == 13) {
      searchArtist(8);
    }
  }); 
  
   function searchArtist(limit = null) {
    var text = $("#artistSearchText").val();
    var country = $("#artistCountry").val();
    var genres = $("#artistGenres").val();
    var type = $("#artistType").val();

    $.ajax({
      type: "GET",
      url: "searchArtist",
      data: { text: text, country: country, genres: genres, type: type, limit:limit },
      success: function(data) {
        //alert(JSON.stringify(data))

        $("#searchResult").html(data);
      },
    });
  }

  
  $(document).on("keyup", "#TopArtistSearchText", function(e) {
    e.preventDefault();
    if (e.which == 13) {
      searchTopArtist();
    }    
  });
  //searchTopArtist(8);
  function searchTopArtist(limit = null) {
    var text = $("#TopArtistSearchText").val();
    var country = $("#TopArtistCountry").val();
    var genres = $("#TopArtistGenres").val();

    $.ajax({
      type: "GET",
      url: "searchTopArtist",
      data: { text: text, country: country, genres: genres, limit: limit },
      success: function(data) {
        //alert(JSON.stringify(data))

        $("#searchTopResult").html(data);
      },
    });
  }
</script>

<script>
  var getUrl = window.location;
  var str1 = getUrl.toString()
  if (str1.indexOf('profile') > -1)
  {
    $('.owl-carousel').owlCarousel({
      loop: true,
      items: 1,
      margin: 0,
      nav: true,
      autoHeight: true,
      onTranslate: function(event) {
      
      var currentSlide, player, command;
      
      currentSlide = $('.owl-item.active');
      
      player = currentSlide.find("iframe").get(0);
      
      command = {
      "event": "command",
      "func": "pauseVideo"
      };
      
      if (player != undefined) {
      player.contentWindow.postMessage(JSON.stringify(command), "*");
      
      }
      
      }
      });
  }
  $( ".owl-prev").html('<i class="flaticon-left-arrow"></i>');
  $( ".owl-next").html('<i class="flaticon-right-arrow"></i>'); 
  $(document).ready(function() {
      $('.nice-select').remove();
      $('.js-example-basic-single').select2();
      $('.select2').width('100%');
  });
</script>
<script>
$( document ).ready(function() {
	var userId = '<?php echo e(Session::get('userId')); ?>';
	if (userId) {
		$("#adonis_jp_container").show();
		$("#adonis_jp_container").css("display", "");	
	} else {
		$("#adonis_jp_container").hide();
		$("#adonis_jp_container").css("display", "none");	
	}
    
});

</script>