$(document).ready(function() {
    $("#flow-1-1").hide();
    $("#flow-1-1").delay(300).fadeIn(900);

    $("#flow-3-5").hide();
    $("#flow-3-b").hide();
    $("#flow-3").hide();
    $("#signup").hide();


	

	$("#sign-1-3").click(function() {
		$("#login").show();
		$("#signup").hide();
	});

	$("#log-1-3").click(function() {
		$("#signup").show();
		$("#login").hide();

	});

	$(".slider-reg").click(function() {
		$("#signup").show();
	});


    $("#flow-3-4a").hide();


    $("#flow-3-open").click(function() {
        $("#flow-3").show();
    });
	

(function( $ ) {

	
	$.fn.slideshow = function( options ) {
		options = $.extend({
			wrapper: ".slider-wrapper",
			previous: ".slider-previous",
			next: ".slider-next",
			reg: ".slider-reg",
			slides: ".slide",
			nav: ".slider-nav",
			pagination: ".slider-pagination",
			speed: 500,
			easing: "linear"
			
		}, options);
		
		$.fn.slideshow.index = 0;

		
		var slideTo = function( slide, element ) {
			var $currentSlide = $( options.slides, element ).eq( slide );
			
			$currentSlide.
			animate({
				opacity: 1
			}, options.speed, options.easing ).
			siblings( options.slides ).
			css( "opacity", 0 );	
			
		};
		
		return this.each(function() {
			var $element = $( this ),
				$reg = $( options.reg, $element ),
				$previous = $( options.previous, $element ),
				$next = $( options.next, $element ),
				$pagination = $( options.pagination, $element ),
				$paginationLinks = $( "a", $pagination ),
				total = $( options.slides ).length;
				
				$( options.slides, $element ).each(function() {
					var $slide = $( this );
					var image = $slide.data( "image" );
					$slide.css( "backgroundImage", "url(" + image + ")" );
				});
				
				
				$element.hover(function() {
					$( options.nav, $element ).stop( true, true ).show();	

				}, function() {
					$( options.nav, $element ).stop( true, true ).show();	
					
				});

	$reg.hide();

				
								
			$next.on( "click", function() {
				$.fn.slideshow.index++;
				$previous.show();
				
				if( $.fn.slideshow.index == total - 1 ) {
					$.fn.slideshow.index = total - 1;
					$next.hide();	
					$("#ab").show();
					$reg.show();	
					
					

				} 
				
				slideTo( $.fn.slideshow.index, $element );
				$paginationLinks.eq( $.fn.slideshow.index ).addClass( "current" ).
					siblings().removeClass( "current" );	
				
			});
			
			$previous.on( "click", function() {
				$.fn.slideshow.index--;
				$next.show();
				$("#ab").hide();
				$reg.hide();
				
				if( $.fn.slideshow.index == 0 ) {
					$.fn.slideshow.index = 0;
					$previous.hide();	
				}
				
				slideTo( $.fn.slideshow.index, $element );
				$paginationLinks.eq( $.fn.slideshow.index ).addClass( "current" ).
					siblings().removeClass( "current" );	
				
			});
			
			$paginationLinks.on( "click", function( e ) {
				e.preventDefault();
				var $a = $( this ),
					elemIndex = $a.index();
					$.fn.slideshow.index = elemIndex;
					
					if( $.fn.slideshow.index > 0 ) {
						$previous.show();
						
					} else {
						$previous.hide();

					}
					
					if( $.fn.slideshow.index == total - 1 ) {
						$.fn.slideshow.index = total - 1;
						$next.hide();
					} else {
						$next.show();
					}
					
					
					
					slideTo( $.fn.slideshow.index, $element );
					$a.addClass( "current" ).
					siblings().removeClass( "current" );
				
			});


			
		});
	};
	
	$(function() {
		$( "#main-slider" ).slideshow();
		
	});
	
})( jQuery );

/*---------------------------------------------------------------------------------------------*/

$("#pm-3").hide();
$("#plant-1").hide();
$("#plant-2").hide();
$("#next").hide();
$("#watering").hide();

$("#add-plant").click(function() {
	$("#scan-plant-img").hide();
	$("#pm-3").show();
	$("#plant-1").show();
	$("#plant-2").show();
	$("#next").show();
});

$("#next").click(function() {
	$("#plant-menu").hide();
	$("#watering").show();
});

$("#done").click(function() {
	$("#watering").hide();
	$("#plants-home").show();
});

});

window.onscroll = function() {myFunction()};

var navbar = document.getElementById("menubar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

/*------------------------------------------------------------*/

$('#add-plant-btn').click(function() {
    $('#file').click();
});

$("#invt").hide();
$("#added-plant-container").show();

/*------Photo upload------*/
function fileValidation() {
    var fileInput =
        document.getElementById('file');
     
    var filePath = fileInput.value;

    // Allowing file type
    var allowedExtensions =
            /(\.jpg|\.jpeg|\.png|\.gif)$/i;
     
    if (!allowedExtensions.exec(filePath)) {
        alert('Please submit a photo');
        fileInput.value = '';
        return false;
    }
    else
    {
     
        // Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(
                    'img-container').innerHTML =
                    '<img src="' + e.target.result
                    + '" style="height:136px; width: 138px;border-radius: 10px"/>';
            };
             
            reader.readAsDataURL(fileInput.files[0]);
        }
    }

    /*--when image uploaded, hides the buttons and shows the loading bar--*/
    $("#img-upload-btn").hide();
    $("#img-upload-btn2").hide();
    $("#loading-bar-text").show();
    $("#img-loading-bar").show();
    $("#img-loading-bar").delay(9900).hide(400);
    $("#image-input").delay(10000).hide(500);
    $("#result-container").delay(10400).show(500);
}

$("#time-btn").click(function() {
	$("#time").click();
});

const form = document.getElementById('form-time');
form.addEventListener('submit', function(event) {
	event.preventDefault();

	const timeInput = document.getElementById('time');
	const selectedTime = timeInput.value;

	console.log(selectedTime);
});

window.onload = function() {
	location.reload();
}















