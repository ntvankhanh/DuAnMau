<?php
// có class chứa các function thực thi xử lý logic 
class ProductController
{
    public $modelProduct;

    public function __construct()
    {
        $this->modelProduct = new ProductModel();
    }

    public function Home()
    {
        $search = $_GET['search'] ?? '';
        $products = $this->modelProduct->getAllProduct($search);
        require_once __DIR__ . '/../../views/Admin/Products/index.php';
    }

    public function createForm()
    {
        // Lấy danh sách danh mục
        require_once __DIR__ . '/../../models/Category.php';
        $conn = connectDB();
        $categoryModel = new Category($conn);
        $categories = $categoryModel->all();
        // Hiển thị form thêm sản phẩm
        require_once __DIR__ . '/../../views/Admin/Products/product_create.php';
    }

    public function store($data)
    {
        // Xử lý upload ảnh
        if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
            $targetDir = 'uploads/imgproduct/';
            $fileName = time() . '_' . basename($_FILES['img']['name']);
            $targetFile = $targetDir . $fileName;
            if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFile)) {
                $data['img'] = $fileName;
            } else {
                $data['img'] = null; // Nếu upload lỗi thì dùng ảnh mặc định
            }
        } else {
            $data['img'] = null; // Nếu không upload thì dùng ảnh mặc định
        }
        $this->modelProduct->createProduct($data);
        header('Location: index.php?act=products');
        exit;
    }

    public function editForm($id)
    {
        $product = $this->modelProduct->getProductById($id);
        // Lấy danh sách danh mục
        require_once __DIR__ . '/../../models/Category.php';
        $conn = connectDB();
        $categoryModel = new Category($conn);
        $categories = $categoryModel->all();
        require_once __DIR__ . '/../../views/Admin/Products/product_edit.php';
    }

    public function update($id, $data)
    {
        // Lấy thông tin sản phẩm cũ
        $oldProduct = $this->modelProduct->getProductById($id);

        // Xử lý upload ảnh mới nếu có
        if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
            $targetDir = 'uploads/imgproduct/';
            $fileName = time() . '_' . basename($_FILES['img']['name']);
            $targetFile = $targetDir . $fileName;
            if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFile)) {
                // Xóa ảnh cũ nếu không phải ảnh mặc định và file tồn tại
                if (!empty($oldProduct['img']) && $oldProduct['img']) {
                    $oldFile = $targetDir . $oldProduct['img'];
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }
                $data['img'] = $fileName;
            } else {
                $data['img'] = $oldProduct['img']; // Nếu upload lỗi thì giữ ảnh cũ
            }
        } else {
            $data['img'] = $oldProduct['img']; // Nếu không upload thì giữ ảnh cũ
        }
        $this->modelProduct->updateProduct($id, $data);
        header('Location: index.php?act=products');
        exit;
    }

    public function delete($id)
    {
        $this->modelProduct->deleteProduct($id);
        header('Location: index.php?act=products');
        exit;
    }
}
