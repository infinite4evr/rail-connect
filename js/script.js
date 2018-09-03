 var typed3 = new Typed('.role', {
    strings: ['Rail_Connect-The Railway Management System.', 'Live Status.Ticket Booking.Train Enquiry.', 'All at one Place.'],
    typeSpeed: 100,
    backSpeed: 100,
    backDelay:1500,
     // this is a default
    loop: true
  });
    

$(".videoc").click(function(){this.paused?this.play():this.pause();});
				var lastScrollTop=60;
				$(document).scroll(function(event){var sc=$(this).scrollTop();
					if(sc>lastScrollTop)
					{$("#header").css("display","none");
			    }
				else
					{   if($(document).width()>980 && $(document).scrollTop()<60)
						$("#header").css("display","");
					}
					});
