var typed3 = new Typed('.Status', {
    strings: ['Rail_Connect-The Railway Management System.', 'Live Status.Ticket Booking.Train Enquiry.', 'All at one Place.'],
    typeSpeed: 100,
    backSpeed: 100,
    backDelay:1500,
    cursorChar:'',
     // this is a default
    loop: true
  });
 var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
 