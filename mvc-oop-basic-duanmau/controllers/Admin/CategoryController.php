<?php

require_once __DIR__ . '/../../models/Category.php';
require_once __DIR__ . '/../../commons/function.php';

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $conn = connectDB();
        $this->categoryModel = new Category($conn);
    }

    // Hiển thị tất cả danh mục
    public function index() {
        $categories = $this->categoryModel->all();
        include __DIR__ . '/../../views/Admin/category/category_index.php';
    }

    // Hiển thị form thêm mới
    public function createForm() {
        include __DIR__ . '/../../views/Admin/category/category_create.php';
    }

    // Xử lý thêm mới
    public function store($name) {
        // Validate không để trống
        if (trim($name) === '') {
            $_SESSION['error_message'] = 'Tên danh mục không được để trống!';
            header('Location: index.php?act=category-create-form');
            exit;
        }
        // Kiểm tra trùng tên danh mục
        $categories = $this->categoryModel->all();
        foreach ($categories as $cat) {
            if (mb_strtolower(trim($cat['name'])) === mb_strtolower(trim($name))) {
                $_SESSION['error_message'] = 'Tên danh mục đã tồn tại!';
                header('Location: index.php?act=category-create-form');
                exit;
            }
        }
        $this->categoryModel->create($name);
        $_SESSION['success_message'] = 'Thêm danh mục thành công!';
        header('Location: index.php?act=category');
        exit;
    }

    // Hiển thị form sửa
    public function editForm($id) {
        $category = $this->categoryModel->find($id);
        include __DIR__ . '/../../views/Admin/category/category_edit.php';
    }

    // Xử lý cập nhật
    public function update($id, $name) {
        // Validate không để trống
        if (trim($name) === '') {
            $_SESSION['error_message'] = 'Tên danh mục không được để trống!';
            header('Location: index.php?act=category-edit-form&id=' . $id);
            exit;
        }
        // Kiểm tra trùng tên danh mục (trừ chính nó)
        $categories = $this->categoryModel->all();
        foreach ($categories as $cat) {
            if ($cat['id'] != $id && mb_strtolower(trim($cat['name'])) === mb_strtolower(trim($name))) {
                $_SESSION['error_message'] = 'Tên danh mục đã tồn tại!';
                header('Location: index.php?act=category-edit-form&id=' . $id);
                exit;
            }
        }
        $this->categoryModel->update($id, $name);
        $_SESSION['success_message'] = 'Cập nhật danh mục thành công!';
        header('Location: index.php?act=category');
        exit;
    }

    // Xóa danh mục
    public function delete($id) {
        $this->categoryModel->delete($id);
        header('Location: index.php?act=category');
        exit;
    }
}
