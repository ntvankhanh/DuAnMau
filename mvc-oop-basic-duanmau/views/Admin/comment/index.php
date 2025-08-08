<?php include __DIR__ . '/../layout/Header.php'; ?>

<div class="container my-5">
    <h2 class="mb-4 text-center">Quản lý bình luận</h2>
    <?php if (!empty($comments)): ?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sản phẩm</th>
                    <th>Người dùng</th>
                    <th>Nội dung</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $c): ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><?= htmlspecialchars($c['product_name']) ?></td>
                        <td><?= htmlspecialchars($c['username']) ?></td>
                        <td><?= nl2br(htmlspecialchars($c['content'])) ?></td>
                        <td><?= $c['created_at'] ?></td>
                        <td>
                            <a href="index.php?act=admin-comment-delete&id=<?= $c['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa bình luận này?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Chưa có bình luận nào.</div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
