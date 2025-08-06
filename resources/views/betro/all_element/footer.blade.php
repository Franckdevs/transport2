<script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            Toastify({
                text: "{{ $error }}",
                duration: 5000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#f44336", // rouge
                stopOnFocus: true,
            }).showToast();
        @endforeach
    @endif

    @if (session('error'))
        Toastify({
            text: "{{ session('error') }}",
            duration: 5000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "#f44336",
            stopOnFocus: true,
        }).showToast();
    @endif

    @if (session('success'))
        Toastify({
            text: "{{ session('success') }}",
            duration: 5000,
            close: true,
            gravity: "top",
            position: "right",
            backgroundColor: "#4CAF50", // vert
            stopOnFocus: true,
        }).showToast();
    @endif
</script>

<footer class="page-footer px-xl-4 px-sm-2 px-0 py-3">
      <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center">
        <p class="col-md-4 mb-0 text-muted"> &copy; Copyright 2025</p>
      </div>
    </footer>

    </div>

  <!-- Jquery Page Js -->
  <script src="../assets/js/theme.js"></script>
  <!-- Plugin Js -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>
  <script src="../assets/js/bundle/dataTables.bundle.js"></script>
  <!-- Vendor Script -->
  <script src="../assets/js/bundle/apexcharts.bundle.js"></script>

</body>

</html>
