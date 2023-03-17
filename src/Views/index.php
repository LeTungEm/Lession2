<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
                alt="">
        </nav>
        <!-- Form search -->
        <form class="form-inline mt-3">
            <input style="border-width: 5px;" class="form-control w-100 mr-sm-2 text-center" type="search"
                placeholder="Search" aria-label="Search">
        </form>
    </header>

    <body>
        <div class="py-4">
            Search found 15 result
            <!-- Insert category button -->
            <div 
                data-toggle="modal" 
                data-target="#insertCategory" 
                class="float-right border border-primary rounded-circle p-1">
                <i class='fas fa-plus mx-1 text-primary' style='font-size:36px'></i>
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
                    $categoryList = $Category->getAll();
                    $data = array();
                    $data[] = $Category->buildTree('0',$categoryList);
                    function xuat($list, $count){
                        foreach ($list as $value) { 
                ?>
                            <tr>
                            <th scope='row'><?php echo $value->getId() ?></th>
                            <td style="padding-left: <?php echo $count*20; ?>px;"><?php echo ($count > 0)?"|__":'';echo $value->getName() ?></td>
                            </tr>
                <?php
                            if(count($value->getListChild()[0]) > 0){
                                $count++;
                                xuat($value->getListChild()[0], $count);
                            }
                            $count = 0;
                        }
                    }
                    xuat($data[0], 0); 
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
    </body>

    <!-- Form insert category -->
    <div class="modal fade" id="insertCategory" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>





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