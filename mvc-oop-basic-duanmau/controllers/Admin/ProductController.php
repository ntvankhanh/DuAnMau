<?php
class ProductController
{
    public $modelProduct;

    public function __construct()
    {
        try {
            $this->modelProduct = new ProductModel();
        } catch (Exception $e) {
            $_SESSION['error_message'] = 'Lỗi khởi tạo mô hình sản phẩm: ' . $e->getMessage();
            header('Location: index.php?act=products');
            exit;
        }
    }

    public function Home()
    {
        $search = filter_input(INPUT_GET, 'search') ?? '';
        $products = $this->modelProduct->getAllProduct($search);
        if (empty($products)) {
            $_SESSION['error_message'] = 'Không tìm thấy sản phẩm.';
        }
        require_once __DIR__ . '/../../views/Admin/Products/index.php';
    }

    public function createForm()
    {
        try {
            require_once __DIR__ . '/../../models/Category.php';
            $conn = connectDB();
            $categoryModel = new Category($conn);
            $categories = $categoryModel->all();
            if (empty($categories)) {
                $_SESSION['error_message'] = 'Không có danh mục nào.';
            }
        } catch (Exception $e) {
            $_SESSION['error_message'] = 'Lỗi kết nối cơ sở dữ liệu: ' . $e->getMessage();
            header('Location: index.php?act=products');
            exit;
        }
        require_once __DIR__ . '/../../views/Admin/Products/product_create.php';
    }

    public function store($data)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        // Xác thực các trường bắt buộc
        if (empty($data['name']) || !isset($data['price']) || !isset($data['quantity']) || !isset($data['category_id'])) {
            $_SESSION['error_message'] = 'Vui lòng điền đầy đủ thông tin!';
            header('Location: index.php?act=product-create-form');
            exit;
        }
        // Xác thực kiểu số và không âm
        if (!is_numeric($data['price']) || $data['price'] < 0 || !is_numeric($data['quantity']) || $data['quantity'] < 0) {
            $_SESSION['error_message'] = 'Giá và số lượng phải là số không âm!';
            header('Location: index.php?act=product-create-form');
            exit;
        }
        
        if (!empty($data['date'])) {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $data['date']);
            if (!$date || $date->format('Y-m-d H:i:s') !== $data['date']) {
                $_SESSION['error_message'] = 'Định dạng ngày giờ không hợp lệ!';
                header('Location: index.php?act=product-create-form');
                exit;
            }
            $data['date'] = $date->format('Y-m-d H:i:s');
        } else {
            $data['date'] = (new DateTime())->format('Y-m-d H:i:s');
        }
        // Xử lý ảnh
        $data['img'] = 'default.jpg';
        if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
            $allowedTypes = ['image/jpeg', 'image/png'];
            if (in_array($_FILES['img']['type'], $allowedTypes) && $_FILES['img']['size'] <= 2 * 1024 * 1024) {
                $targetDir = 'Uploads/imgproduct/';
                // Đảm bảo thư mục tồn tại
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }
                $fileName = time() . '_' . basename($_FILES['img']['name']);
                $targetFile = $targetDir . $fileName;
                if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFile)) {
                    $data['img'] = $fileName;
                } else {
                    $_SESSION['error_message'] = 'Lỗi tải lên ảnh!';
                    header('Location: index.php?act=product-create-form');
                    exit;
                }
            } else {
                $_SESSION['error_message'] = 'File ảnh không hợp lệ hoặc quá lớn!';
                header('Location: index.php?act=product-create-form');
                exit;
            }
        }
        // Vệ sinh dữ liệu
        $data['name'] = htmlspecialchars(trim($data['name']));
        try {
            $this->modelProduct->createProduct($data);
            $_SESSION['success_message'] = 'Thêm sản phẩm thành công!';
            header('Location: index.php?act=products');
            exit;
        } catch (Exception $e) {
            $_SESSION['error_message'] = 'Lỗi thêm sản phẩm: ' . $e->getMessage();
            header('Location: index.php?act=product-create-form');
            exit;
        }
    }

    public function editForm($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            $_SESSION['error_message'] = 'ID sản phẩm không hợp lệ!';
            header('Location: index.php?act=products');
            exit;
        }
        $product = $this->modelProduct->getProductById($id);
        if (!$product) {
            $_SESSION['error_message'] = 'Sản phẩm không tồn tại!';
            header('Location: index.php?act=products');
            exit;
        }
        try {
            require_once __DIR__ . '/../../models/Category.php';
            $conn = connectDB();
            $categoryModel = new Category($conn);
            $categories = $categoryModel->all();
        } catch (Exception $e) {
            $_SESSION['error_message'] = 'Lỗi kết nối cơ sở dữ liệu: ' . $e->getMessage();
            header('Location: index.php?act=products');
            exit;
        }
        require_once __DIR__ . '/../../views/Admin/Products/product_edit.php';
    }

    public function update($id, $data)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if (!is_numeric($id) || $id <= 0) {
            $_SESSION['error_message'] = 'ID sản phẩm không hợp lệ!';
            header('Location: index.php?act=products');
            exit;
        }
        $oldProduct = $this->modelProduct->getProductById($id);
        if (!$oldProduct) {
            $_SESSION['error_message'] = 'Sản phẩm không tồn tại!';
            header('Location: index.php?act=products');
            exit;
        }
        if (empty($data['name']) || !isset($data['price']) || !isset($data['quantity']) || !isset($data['category_id'])) {
            $_SESSION['error_message'] = 'Vui lòng điền đầy đủ thông tin!';
            header('Location: index.php?act=product-edit-form&id=' . $id);
            exit;
        }
        if (!is_numeric($data['price']) || $data['price'] < 0 || !is_numeric($data['quantity']) || $data['quantity'] < 0) {
            $_SESSION['error_message'] = 'Giá và số lượng phải là số không âm!';
            header('Location: index.php?act=product-edit-form&id=' . $id);
            exit;
        }
        if (!empty($data['date'])) {
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $data['date']);
            if (!$date || $date->format('Y-m-d H:i:s') !== $data['date']) {
                $_SESSION['error_message'] = 'Định dạng ngày giờ không hợp lệ!';
                header('Location: index.php?act=product-edit-form&id=' . $id);
                exit;
            }
            $data['date'] = $date->format('Y-m-d H:i:s');
        } else {
            $data['date'] = $oldProduct['date']; // Giữ nguyên giá trị cũ
        }

        try {
            require_once __DIR__ . '/../../models/Category.php';
            $conn = connectDB();
            $categoryModel = new Category($conn);
        } catch (Exception $e) {
            $_SESSION['error_message'] = 'Lỗi kết nối cơ sở dữ liệu: ' . $e->getMessage();
            header('Location: index.php?act=product-edit-form&id=' . $id);
            exit;
        }
        $data['img'] = $oldProduct['img'];
        if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
            $allowedTypes = ['image/jpeg', 'image/png'];
            if (in_array($_FILES['img']['type'], $allowedTypes) && $_FILES['img']['size'] <= 2 * 1024 * 1024) {
                $targetDir = 'Uploads/imgproduct/';
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }
                $fileName = time() . '_' . basename($_FILES['img']['name']);
                $targetFile = $targetDir . $fileName;
                if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFile)) {
                    if (!empty($oldProduct['img']) && $oldProduct['img'] !== 'default.jpg' && file_exists($targetDir . $oldProduct['img'])) {
                        unlink($targetDir . $oldProduct['img']);
                    }
                    $data['img'] = $fileName;
                } else {
                    $_SESSION['error_message'] = 'Lỗi tải lên ảnh!';
                    header('Location: index.php?act=product-edit-form&id=' . $id);
                    exit;
                }
            } else {
                $_SESSION['error_message'] = 'File ảnh không hợp lệ hoặc quá lớn!';
                header('Location: index.php?act=product-edit-form&id=' . $id);
                exit;
            }
        }
        $data['name'] = htmlspecialchars(trim($data['name']));
        try {
            $this->modelProduct->updateProduct($id, $data);
            $_SESSION['success_message'] = 'Cập nhật sản phẩm thành công!';
            header('Location: index.php?act=products');
            exit;
        } catch (Exception $e) {
            $_SESSION['error_message'] = 'Lỗi cập nhật sản phẩm: ' . $e->getMessage();
            header('Location: index.php?act=product-edit-form&id=' . $id);
            exit;
        }
    }

    public function delete($id)
    {
        if (!is_numeric($id) || $id <= 0) {
            $_SESSION['error_message'] = 'ID sản phẩm không hợp lệ!';
            header('Location: index.php?act=products');
            exit;
        }
        $product = $this->modelProduct->getProductById($id);
        if (!$product) {
            $_SESSION['error_message'] = 'Sản phẩm không tồn tại!';
            header('Location: index.php?act=products');
            exit;
        }
        $targetDir = 'Uploads/imgproduct/';
        if (!empty($product['img']) && $product['img'] !== 'default.jpg' && file_exists($targetDir . $product['img'])) {
            unlink($targetDir . $product['img']);
        }
        try {
            $this->modelProduct->deleteProduct($id);
            $_SESSION['success_message'] = 'Xóa sản phẩm thành công!';
            header('Location: index.php?act=products');
            exit;
        } catch (Exception $e) {
            $_SESSION['error_message'] = 'Lỗi xóa sản phẩm: ' . $e->getMessage();
            header('Location: index.php?act=products');
            exit;
        }
    }
}
?>