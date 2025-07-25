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
        $this->categoryModel->create($name);
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
        $this->categoryModel->update($id, $name);
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
