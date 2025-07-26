<?php include __DIR__ . '/../layout/Header.php'; ?>

        <!-- Main Content -->
        <div class="content col-md-9 col-lg-10">
            <div class="container-fluid">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h2 class="mb-4 text-center">Danh sách danh mục</h2>
                        <a href="index.php?act=category-create-form" class="add-btn">Thêm danh mục mới</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên danh mục</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($categories)) foreach ($categories as $i => $cat): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= htmlspecialchars($cat['name']) ?></td>
                                    <td>
                                        <a href="index.php?act=category-edit-form&id=<?= $cat['id'] ?>" class="button edit">Sửa</a>
                                        <a href="index.php?act=category-delete&id=<?= $cat['id'] ?>" class="button delete" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>