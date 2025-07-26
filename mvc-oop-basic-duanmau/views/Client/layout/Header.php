<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Giao diện Client với Bootstrap 5</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
  <!-- Thanh điều hướng -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom py-2">
    <div class="container d-flex align-items-center justify-content-between">
      <a class="navbar-brand fw-bold d-flex align-items-center gap-3" href="index.php" style="padding:0;">
        <img src="https://scontent.fhan2-3.fna.fbcdn.net/v/t39.30808-6/523362984_1236282104916129_3802945803135118825_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=127cfc&_nc_ohc=WXHHj8nk_eIQ7kNvwEnBu8z&_nc_oc=AdmKqyFNsRgTyX5X8RrC8KzKxY9qGKi2TROtsC1Wex8QfCR8i-LcE0DhTWT2WzO-vX0&_nc_zt=23&_nc_ht=scontent.fhan2-3.fna&_nc_gid=AYGk6bqRf8Q_MCKZAnOL8Q&oh=00_AfSTw9dD1XgsedoqDQWIJKNsaL8pWm7KiEezA0IdhntJcA&oe=688A7F13" alt="Cherry Cakes Logo" style="height:72px; width:auto; object-fit:contain; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.07);">
        <span class="fs-4 text-dark" style="letter-spacing:1px;">Cherry Cakes</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse flex-grow-0" id="navbarNav">
        <ul class="navbar-nav align-items-center gap-2">
          <li class="nav-item">
            <a class="nav-link active text-dark fw-semibold px-3" aria-current="page" href="#">Trang chủ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark fw-semibold px-3" href="index.php?act=gioithieu">Giới thiệu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark fw-semibold px-3" href="#">Dịch vụ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark fw-semibold px-3" href="#">Liên hệ</a>
          </li>
        </ul>
        <div class="dropdown ms-4">
          <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="gap:8px;">
            <?php if (!empty($user['avatar'])): ?>
              <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="Avatar" style="width:40px; height:40px; object-fit:cover; border-radius:50%; border:2px solid #ddd;">
            <?php else: ?>
              <i class="bi bi-person-circle fs-2"></i>
            <?php endif; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="#">Đăng nhập</a></li>
            <li><a class="dropdown-item" href="#">Đăng ký</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  