<?php include __DIR__ . '/layout/Header.php'; ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
          <h2 class="mb-4 text-center text-primary">Cập nhật thông tin cá nhân</h2>
          <form method="post" action="index.php?act=update-user" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="full_name" class="form-label">Họ và tên</label>
              <input type="text" class="form-control" id="full_name" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Số điện thoại</label>
              <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
            </div>
            <div class="mb-3">
              <label for="avatar" class="form-label">Ảnh đại diện</label>
              <input type="file" class="form-control" id="avatar" name="avatar">
              <?php if (!empty($user['avatar'])): ?>
                <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="Avatar" style="width:60px; height:60px; object-fit:cover; border-radius:50%; margin-top:8px;">
              <?php endif; ?>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Mật khẩu mới (nếu muốn đổi)</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>
