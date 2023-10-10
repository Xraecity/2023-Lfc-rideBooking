<script src="../googleMap/googleMap.js"></script>
            <div class="map" id="gmp-map" style="display: none;"></div>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1W-Ozu30HBRPesfZcEN2ftAo2y_gBzqY&libraries=places&callback=initMap&solution_channel=GMP_QB_addressselection_v1_cABC" async defer></script>
    
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018 by <a href="https://xraecity.com/wp/">xraecity</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    
    <!-- page container area end -->
    <!-- offset area start -->
    
    <!-- offset area end -->
    <!-- jquery latest version -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    let phone = document.getElementById("phone");

    phone.addEventListener("input", function () {
        let inputValue = phone.value.replace(/\D/g, ''); // Remove non-numeric characters
        if (inputValue.length > 10) {
            inputValue = inputValue.slice(0, 10); // Limit to 10 digits
        }

        if (inputValue.length >= 1) {
            inputValue = "(" + inputValue;
        }

        if (inputValue.length >= 9) {
            inputValue = inputValue.slice(0, 4) + ") " + inputValue.slice(4);
        }

        if (inputValue.length >= 9) {
            inputValue = inputValue.slice(0, 9) + "-" + inputValue.slice(9);
        }

        phone.value = inputValue;
    });
    
});
    </script>
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    

    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

    
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>


</body>

</html>