<footer class="bg-dark text-white py-5">
    <div class="container">
      <div class="row g-4">
        <!-- Menu Giới thiệu -->
        <div class="col-md-3 col-sm-6">
          <h5 class="fw-bold mb-3 text-uppercase">Giới thiệu</h5>
          <ul class="list-unstyled">
            <li><a href="index.php?act=gioithieu" class="text-white text-decoration-none hover:text-primary">Về Cherry Cakes</a></li>
          </ul>
        </div>
        <!-- Menu Sản phẩm -->
        <div class="col-md-3 col-sm-6">
          <h5 class="fw-bold mb-3 text-uppercase">Sản phẩm</h5>
          <ul class="list-unstyled">
            <li><a href="index.php?act=sanpham" class="text-white text-decoration-none hover:text-primary">Tất cả sản phẩm</a></li>
            <?php
            require_once __DIR__ . '/../../../models/Category.php';
            $conn = connectDB();
            $categoryModel = new Category($conn);
            $categories = $categoryModel->all();
            foreach ($categories as $cat): ?>
              <li>
                <a href="index.php?act=sanpham&category=<?= $cat['id'] ?>" class="text-white text-decoration-none hover:text-primary">
                  <?= htmlspecialchars($cat['name']) ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <!-- Menu Liên hệ -->
        <div class="col-md-3 col-sm-6">
          <h5 class="fw-bold mb-3 text-uppercase">Liên hệ</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white text-decoration-none hover:text-primary">Hotline:0985 914 005</a></li>
            <li><a href="#" class="text-white text-decoration-none hover:text-primary">Email: khanhntvph52932@gmail.com</a></li>
            <li><a href="#" class="text-white text-decoration-none hover:text-primary">Địa chỉ: 132 Xuân phương, Nam Từ Liêm, Hà Nội</a></li>
          </ul>
        </div>
        <!-- Mạng xã hội -->
        <div class="col-md-3 col-sm-6">
          <h5 class="fw-bold mb-3 text-uppercase">Kết nối với chúng tôi</h5>
          <div class="d-flex gap-3">
            <a href="#" class="text-white fs-4 hover:text-primary"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white fs-4 hover:text-primary"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-white fs-4 hover:text-primary"><i class="bi bi-twitter"></i></a>
            <a href="#" class="text-white fs-4 hover:text-primary"><i class="bi bi-youtube"></i></a>
          </div>
        </div>
      </div>
      <hr class="my-4 border-secondary">
      <div class="text-center">
        <p class="mb-0">&copy; 2025 Cherry Cakes. Mọi quyền được bảo lưu.</p>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .hover\:text-primary:hover {
      color: #0d6efd;
    }
  </style>
</body>
</html>