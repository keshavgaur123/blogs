<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Modal</title>

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <style>
        body {
            background: #f5f7fa;
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>

    <!-- Logout Button -->
    <button class="btn btn-danger logout-btn" data-bs-toggle="modal" data-bs-target="#logoutModal">
        Logout
    </button>

    <!-- Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow">

                <!-- Header -->
                <div class="modal-header border-0">
                    <h5 class="modal-title">Confirm Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Body -->
                <div class="modal-body text-center">
                    <h6 class="mb-3">Are you sure?</h6>
                    <p class="text-muted">Do you want to logout from the system?</p>
                </div>

                <!-- Footer -->
                <div class="modal-footer border-0 justify-content-center">

                    <!-- Cancel -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        <!-- Laravel CSRF -->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <button type="submit" class="btn btn-danger">
                            Yes, Logout
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (includes Popper) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

</body>
</html>