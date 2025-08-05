
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if (!empty($_SESSION['success_message'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        icon: 'success',
        title: 'Thành công',
        text: <?= json_encode($_SESSION['success_message']) ?>
      });
    });
  </script>
  <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>
<?php if (!empty($_SESSION['error_message'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      Swal.fire({
        icon: 'error',
        title: 'Thất bại',
        text: <?= json_encode($_SESSION['error_message']) ?>
      });
    });
  </script>
  <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>
</body>
</html>