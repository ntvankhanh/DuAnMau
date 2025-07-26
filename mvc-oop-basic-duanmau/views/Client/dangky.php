<?php include __DIR__ . '/layout/Header.php'; ?>


<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
          <h2 class="mb-4 text-center text-primary">Đăng ký tài khoản</h2>
          <form method="post" action="index.php?act=register">
            <div class="mb-3">
              <label for="username" class="form-label">Tên đăng nhập</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Mật khẩu</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Số điện thoại</label>
              <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
              <label for="full_name" class="form-label">Họ và tên</label>
              <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
          </form>
          <div class="text-center mt-3">
            <a href="index.php?act=dangnhap">Đã có tài khoản? Đăng nhập</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include __DIR__ . '/layout/footer.php'; ?>