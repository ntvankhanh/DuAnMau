<?php include __DIR__ . '/../layout/Header.php'; ?>

        <!-- Nội dung ở trong -->
        <div class="content col-md-9 col-lg-10">
            <div class="form-container">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Thêm danh mục mới</h4>
                    </div>
                    <div class="card-body">
                        <form action="index.php?act=category-store" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Tên danh mục:</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên danh mục">
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Lưu
                                </button>
                                <a href="index.php?act=category" class="btn btn-link">Quay lại danh sách</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include __DIR__ . '/../layout/footer.php'; ?>