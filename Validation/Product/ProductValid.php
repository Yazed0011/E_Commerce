<?php 
namespace Validation\Product;
class ProductValid {
    public function validate(array $data) {
        $errors = [];
        if (empty($data['name'])) {
            $errors['name'] = 'Name is required';
        }
        if (empty($data['price'])) {
            $errors['price'] = 'Price is required';
        }
        if (empty($data['quantity'])) {
            $errors['quantity'] = 'Quantity is required';
        }
        if (empty($data['description'])) {
            $errors['description'] = 'Description is required';
        }
        if (empty($data['image'])) {
            $errors['image'] = 'Image is required';
        }
        if (empty($data['category_id'])) {
            $errors['category_id'] = 'Category is required';
        }
        if (!empty($errors)) {
            return $errors;
        }
        return true;
}
}

