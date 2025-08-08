<?php include __DIR__ . '/../layout/Header.php'; ?>

<!-- Main Content -->
<div class="content col-md-9 col-lg-10 ms-auto">
    <div class="container-fluid py-4">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold text-dark">Danh sách danh mục</h2>
                    <a href="index.php?act=category-create-form" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-plus-circle me-2"></i>Thêm danh mục mới
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4">ID</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col" class="text-end pe-4">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($categories)): ?>
                                <?php foreach ($categories as $i => $cat): ?>
                                    <tr>
                                        <td class="ps-4"><?= $i + 1 ?></td>
                                        <td><?= htmlspecialchars($cat['name']) ?></td>
                                        <td class="text-end pe-4">
                                            <a href="index.php?act=category-edit-form&id=<?= $cat['id'] ?>" class="btn btn-sm btn-outline-warning rounded-pill px-3 me-2">
                                                <i class="bi bi-pencil me-1"></i>Sửa
                                            </a>
                                            <a href="index.php?act=category-delete&id=<?= $cat['id'] ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')">
                                                <i class="bi bi-trash me-1"></i>Xóa
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Chưa có danh mục nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>