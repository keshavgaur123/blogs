
@include('layouts.navbar') 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog View</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { padding-top: 75px; }

        .blog-title {
            font-size: 38px;
            font-weight: 700;
        }

        .blog-meta {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .blog-image-full img {
            width: 100%;
            height: 350px;
            object-fit: cover;
        }

        .blog-content {
            font-size: 18px;
            line-height: 1.8;
        }
    </style>
</head>





<body>



<div class="container mt-4">
    <div class="row">

 <div class="blog-image-full mb-4">
                <img src="../assets/images/Jeremy Wade.jpg" alt="">
                 <h1 class="blog-title">Jeremy Wade</h1>
            </div>

        <!-- LEFT CONTENT -->
        <div class="col-lg-8">

            <a href="#" class="btn btn-outline-info mt-3">⬅ Back to Blogs</a>

            <h1 class="blog-title">Jeremy Wade</h1>

            <div class="blog-meta">
                👤 <strong>Admin</strong>
                <span class="ms-3">📅 April 30, 2026</span>
            </div>

           

            <div class="blog-content">
                <p>
                    Jeremy Wade is a British biologist, author, and television presenter.
                    He is best known for the TV series River Monsters.
                </p>
            </div>

        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="col-md-4">

            <div class="card p-3 mb-4">
                <h5 class="fw-bold mb-3">Popular Posts</h5>

                <ul class="list-unstyled">

                    <li class="mb-3 d-flex align-items-center">
                        <img src="assets/images/jimmychin.jpg"
                             style="width:60px;height:60px;object-fit:cover;margin-right:10px;">
                        <a href="#" class="text-dark">Jimmy Chin</a>
                    </li>

                    <li class="mb-3 d-flex align-items-center">
                        <img src="assets/images/chrisjohns.jpg"
                             style="width:60px;height:60px;object-fit:cover;margin-right:10px;">
                        <a href="#" class="text-dark">Chris Johns</a>
                    </li>

                </ul>
            </div>

        </div>

    </div>
</div>

</body>
</html>