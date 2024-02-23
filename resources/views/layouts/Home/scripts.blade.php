    <script>
        document.getElementById ('pageHome').style.display = 'none';
        var time = document.getElementById ('time');
        // Function to start the countdown
    function startCountdown() {
      var count = 10; // Set the initial count

      // Update the countdown every second
        var countdownInterval = setInterval(function() {
        // Display the current count
        document.getElementById('countdown').innerText =  count ;

        // Decrease the count
        count--;
        if(count === 1){
            document.getElementById('text').innerText =  'بداية العرض' ;
        }
        // If the count is zero, redirect to another page
        if (count === 0) {
          clearInterval(countdownInterval); // Stop the countdown
          //window.location.href = 'https://example.com'; // Redirect to another page
        //   document.getElementById ('index').style.display = 'none';
        //   document.getElementById ('pageHome').style.display = 'block';
        }
      }, 1000); // Update every second (1000 milliseconds)
    }

    // Start the countdown when the page loads
    startCountdown();
        console.log('page home');
        $(document).ready(function() {
            // $('#loading-spinner').show();
            $('#pageHome').hide();
        });
    </script>
    @yield('js')
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('Home/lib/wow/wow.min.js')}}"></script>
    <script src="{{ asset('Home/lib/easing/easing.min.js')}}"></script>
    <script src="{{ asset('Home/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ asset('Home/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{ asset('Home/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('Home/lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{ asset('Home/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{ asset('Home/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('Home/js/main.js')}}"></script>
</body>

</html>
