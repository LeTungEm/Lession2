<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body class="container">

    <header>
        <nav class="navbar navbar-expand-lg navbar-light w-100">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item mx-lg-3 my-1">
                        <a class="w-100 btn btn-outline-primary px-lg-0 border-0" href="?">Product</a>
                    </li>
                    <li class="nav-item mx-lg-3 my-1">
                        <a class="w-100 btn btn-outline-primary px-lg-0 border-0 active text-white"
                            href="?">Categories</a>
                    </li>
            </div>
            <!-- Logo LAMPART -->
            <img class="img-fluid navbar-brand" style="width: 100px;"
                src="https://itviec.com/rails/active_storage/representations/proxy/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBeWtwREE9PSIsImV4cCI6bnVsbCwicHVyIjoiYmxvYl9pZCJ9fQ==--2b25eb6264064ff1a8a608c45fefe331e8a13537/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaDdCem9MWm05eWJXRjBTU0lJYW5CbkJqb0dSVlE2RkhKbGMybDZaVjkwYjE5c2FXMXBkRnNIYVFJc0FXa0NMQUU9IiwiZXhwIjpudWxsLCJwdXIiOiJ2YXJpYXRpb24ifX0=--08e921ae99aba104513af6f5a3d61991dfc1c2d0/lampart-logo.jpg"
                alt="logo LAMPART">
        </nav>
        <!-- Form search -->
        <form method="post" class="form-inline mt-3">
            <input style="border-width: 5px;" class="form-control w-100 text-center" type="search" placeholder="Search"
                aria-label="Search">
        </form>
    </header>

    <div>
        <div class="py-4">
            Search found 15 result
            <!-- Insert category button -->
            <div data-toggle="modal" data-target="#insertCategory"
                class="float-right border border-primary rounded-circle p-1">
                <i class="fa fa-plus mx-1 text-primary" style="font-size:36px"></i>
            </div>
        </div>
        <!-- List categories -->
        <table class="table mt-5">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // print each category in categoryTree
                function printCategory($list, $childLevel)
                {
                    foreach ($list as $value) 
                    {
                        ?>
                        <tr>
                            <th>
                                <?php echo $value->getId() ?>
                            </th>
                            <td style="padding-left: <?php echo $childLevel * 20; ?>px;">
                                <?php echo ($childLevel > 0) ? "&verbar;&lowbar;" : '';
                                echo $value->getName() ?>
                            </td>
                            <td class="d-flex">
                                <i 
                                    onclick="changeCategoryDetaillOnFormEdit(<?php echo $value->getId().',\''.$value->getName().'\','.$value->getParentId() ?>)" 
                                    data-toggle="modal"
                                    data-target="#editCategory" 
                                    class="fa fa-edit btn-outline-primary rounded p-1 mr-3" 
                                    style="font-size:22px"></i>
                                <i
                                    onclick="changeCategoryDetaillOnFormCopy(<?php echo $value->getId().',\''.$value->getName().'\','.$value->getParentId() ?>)" 
                                    data-toggle="modal"
                                    data-target="#copyCategory" 
                                    class="fa fa-copy btn-outline-primary rounded p-1 mr-3" 
                                    style="font-size:22px"></i>
                                <i 
                                    onclick="changeDeleteId(<?php echo $value->getId() ?>)" 
                                    data-toggle="modal"
                                    data-target="#deleteCategoryToggle" class="fa fa-trash btn-outline-primary rounded p-1 mr-3"
                                    style='font-size:22px'></i>
                            </td>
                        </tr>
                        <?php
                        if (count($value->getListChild()) > 0) {
                            printCategory($value->getListChild()[0], $childLevel + 1);
                        }
                        $$childLevel = 0;
                    }
                }
                printCategory($categoryTree[0], 0);
                ?>


            </tbody>
        </table>
        <!-- Pagination -->
        <nav class="d-flex justify-content-center" aria-label="...">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Form insert category -->
    <div class="modal fade" id="insertCategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add new category</h5>
                    </div>
                    <div class="modal-body">
                        <label for="categoryName">Category name</label>
                        <input id="categoryName" name="categoryName" class="form-control" type="text">
                        <p class="text-secondary">We'll never share your email with anyone else</p>
                        <label for="parentCategory">Parent category</label>
                        <select id="parentCategory" name="parentCategory" class="form-control">
                            <option value="0">None</option>
                            <?php
                            foreach ($categoryList as $category) 
                            {
                                ?>
                                <option value="<?php echo $category['id'] ?>"><?php echo $category["name"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="modal-footer justify-content-start">
                        <button type="submit" name="btnInsertCategory" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Form edit category -->
    <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit category</h5>
                    </div>
                    <div class="modal-body">
                        <label for="editCategoryName">Category name</label>
                        <input id="editCategoryName" name="editCategoryName" class="form-control" type="text">
                        <p class="text-secondary">We'll never share your email with anyone else</p>
                        <label for="editParentCategory">Parent category</label>
                        <select id="editParentCategory" name="editParentCategory" class="form-control">
                            <option value="0">None</option>
                            <?php
                            foreach ($categoryList as $category) 
                            {
                                ?>
                                <option value="<?php echo $category['id'] ?>"><?php echo $category["name"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="modal-footer  justify-content-start">
                        <input hidden id="editCategoryId" name="editCategoryId" type="text">
                        <button type="submit" name="btnEditCategory" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Form delete category -->
    <div class="modal fade" id="deleteCategoryToggle" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you want to delete this category ?
                </div>
                <div class="modal-footer">
                    <!-- Form delete category -->
                    <form method="post">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input hidden name="deleteId" id="deleteId" type="text" value='jjj'>
                        <button type="submit" name="btnDeleteCategory" class="btn btn-primary">Delete category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Form copy category -->
    <div class="modal fade" id="copyCategory" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Copy category</h5>
                    </div>
                    <div class="modal-body">
                        <label for="copyCategoryName">Category name</label>
                        <input id="copyCategoryName" name="copyCategoryName" class="form-control" type="text">
                        <p class="text-secondary">We'll never share your email with anyone else</p>
                        <label for="copyParentCategory">Parent category</label>
                        <select id="copyParentCategory" name="copyParentCategory" class="form-control">
                            <option value="0">None</option>
                            <?php
                            foreach ($categoryList as $category) 
                            {
                                ?>
                                <option value="<?php echo $category['id'] ?>"><?php echo $category["name"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="modal-footer justify-content-start">
                        <input hidden name="copyCategoryId" id="copyCategoryId" type="text">
                        <button type="submit" name="btnCopyCategory" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Đổi giá trị trên form delete category
        function changeDeleteId(id) 
        {
            document.getElementById("deleteId").value = id;
        }

        // Đổi giá trị trên form edit category
        function changeCategoryDetaillOnFormEdit(id, name, parentId) 
        {
            document.getElementById("editCategoryId").value = id;
            document.getElementById("editCategoryName").value = name;
            document.getElementById("editParentCategory").value = parentId;
        }

        // Đổi giá trị trên form copy category
        function changeCategoryDetaillOnFormCopy(id, name, parentId) 
        {
            document.getElementById("copyCategoryId").value = id;
            document.getElementById("copyCategoryName").value = name;
            document.getElementById("copyParentCategory").value = parentId;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>

</html>