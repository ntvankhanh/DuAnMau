<?php include __DIR__ . '/../layout/Header.php'; ?>

        <!-- Main Content -->
        <div class="content col-md-9 col-lg-10">
            <div class="container-fluid">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h2 class="mb-4 text-center">Sửa danh mục</h2>
                        <form action="index.php?act=category-update" method="post">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($category['id']) ?>">
                            <div class="form-group">
                                <label for="name">Tên danh mục:</label>
                                <input type="text" name="name" id="name" value="<?= htmlspecialchars($category['name']) ?>" required>
                            </div>
                            <button type="submit" class="btn-submit">Cập nhật</button>
                        </form>
                        <div class="text-center">
                            <a href="index.php?act=category" class="back-link">Quay lại danh sách</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>