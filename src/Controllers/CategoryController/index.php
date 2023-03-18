<?php
$category = new Category();
$categoryList = $category->getAll();
$categoryTree = array();
$categoryTree[] = $category->buildTree('0', $categoryList);

if (isset($_POST["btnInsertCategory"])) 
{
    $categoryName = $_POST["categoryName"];
    $parentCategory = $_POST['parentCategory'];
    print_r($category->insertCategory($categoryName, $parentCategory));
}

if (isset($_POST["btnDeleteCategory"])) 
{
    $deleteId = $_POST["deleteId"];
    function deleteCategory($list, $deleteId)
    {
        foreach ($list as $value) {
            // xóa các phần tử con của phần tử cần xóa
            if($value->getParentId() == $deleteId)
            {
                $value->deleteCategory($value->getId());
                deleteCategory($value->getListChild()[0], $value->getId());     
            }
            // Duyệt categoryTree
            else if (count($value->getListChild())) 
            {
                deleteCategory($value->getListChild()[0], $deleteId);
            }
        }
    }
    deleteCategory($categoryTree[0], $deleteId);
    // Xóa phần tử có id đã chọn
    $category->deleteCategory($deleteId);
    
}

if(isset($_POST["btnEditCategory"]))
{
    $categoryId = $_POST["editCategoryId"];
    $categoryName = $_POST["editCategoryName"];
    $parentCategory = $_POST['editParentCategory'];
    if($categoryId == $parentCategory)
    {
        echo "loi";
    }else{
        $category->editCategory($categoryName, $parentCategory, $categoryId);
    }

    // function findInChildCategory($categoryList, $id, $parentId)
    // {
    //     foreach ($categoryList as $value)
    //     {
    //         if($value->getParentId() == $id){
    //             if($value->getId() == $parentId)
    //                 echo "co";
    //         }
    //         else
    //         {
    //             findInChildCategory($value->getListChild()[0], $id, $parentId);
    //         }
    //     }
    // }
    // findInChildCategory($categoryTree[0], $categoryId, $parentCategory);
}

if(isset($_POST["btnCopyCategory"]))
{
    $copyCategoryId = $_POST['copyCategoryId'];
    $copyCategoryName = $_POST["copyCategoryName"];
    $copyParentCategory = $_POST["copyParentCategory"];
    $newId = $category->insertCategory($copyCategoryName, $copyParentCategory);
    function copyCategory($list, $parentId, $newId)
    {
        foreach ($list as $value) {
            // copy các phần tử con của phần tử cần copy
            if($value->getParentId() == $parentId)
            {
                $newParentId = $value->insertCategory($value->getName(), $newId);
                copyCategory($value->getListChild()[0], $value->getId(), $newParentId);     
            }
            // Duyệt categoryTree
            else if (count($value->getListChild())) 
            {
                copyCategory($value->getListChild()[0], $parentId, $newId);
            }
        }
    }
    copyCategory($categoryTree[0], $copyCategoryId, $newId);
}



$categoryList = $category->getAll();
$categoryTree = array();
$categoryTree[] = $category->buildTree('0', $categoryList);
include(ROOT . "/Views/category_view/index.php");
?>