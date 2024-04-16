<!-- slider-closed -->

<footer id="colophon" class="site-footer" >
  <div class="footer-bottom-widgets" style="background-color:#e3154f; padding-bottom: 2em; padding-top: 2em;">
    <div class="container">
      <div class="row">
        <div class="col-lg-2 col-md-6 col-xs-12">
          <div class="footer-logo">
            <div class="media">
              <div class="media-body"> <a href="<?php echo SITEPATH; ?>"><img src="<?php echo SITEPATH; ?>web/images/flogo.png"/></a> </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-xs-12">
          <div class="footer-logo">
            <div class="media">
              <div class="media-body"> <span class="call-us-number"><i class="fa fa-map-marker"></i><strong>All India Students Database <br>
                </strong>
                <p>Cross JP Nagar 1st phase. Near Indira Gandhi circle Bangalore
                  560078</p>
                </span> </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-xs-12">
          <div class="footer-logo">
            <div class="media">
              <div class="media-body"> <span class="call-us-number"><i class="fa fa-phone-square"></i><strong>Customer Support <br>
                </strong><a href="tel:+91 9663953527">+91 9663953527</a></span> </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-xs-12">
          <div class="footer-call-us">
            <div class="media">
              <div class="media-body"> <span class="call-us-number"><i class="fa fa-envelope-o"></i><strong>Contact <br>
                </strong><a href="mailto:info@studentdatabasekart.in">info@studentdatabasekart.in</a></span> </div>
            </div>
            <div class="f_menu"><a href="<?php echo SITEPATH; ?>About-Us">About</a><!--<a href="/FAQ/">FAQ's</a>--><a href="<?php echo SITEPATH; ?>PRIVACY-POLICY">Privacy Policy</a><a href="<?php echo SITEPATH; ?>disclaimer">Disclaimer</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="copyright-bar" style="background:#000">
    <div class="container">
      <div class="pull-left flip copyright">© 2023 by Students Database <a href="<?php echo SITEPATH; ?>terms">terms & conditions</a></div>
    </div>
  </div>
</footer>
<style>


#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#myBtn:hover {
  background-color: #555;
}
</style>
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<script>
// Get the button
let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
<!-- footer-end --> 
<script src="<?php echo SITEPATH; ?>web/js/jquery-3.6.1.min.js" type="text/javascript"></script> 
<script src="<?php echo SITEPATH; ?>web/js/owl.carousel.min.js" type="text/javascript"></script> 
<script src="<?php echo SITEPATH; ?>web/js/scripts.js" type="text/javascript"></script> 

<!-- Optional JavaScript --> 
<!-- jQuery first, then Popper.js, then Bootstrap JS --> 
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> 
<script>
      AOS.init();
    </script>