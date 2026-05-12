<div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Contact Us</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body">

                {{-- Success/Error Messages --}}
                <div id="responseMessage"></div>

                <form id="contactForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name</label>

                        <input type="text" class="form-control" name="name">

                        <small class="text-danger error-name"></small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>

                        <input type="email" class="form-control" name="email">

                        <small class="text-danger error-email"></small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Title</label>

                        <input type="text" class="form-control" name="title">

                        <small class="text-danger error-title"></small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>

                        <textarea class="form-control" name="description" rows="4"></textarea>

                        <small class="text-danger error-description"></small>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        Send Message
                    </button>

                </form>

            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById("contactForm").addEventListener("submit", function (e) {

        e.preventDefault();

        // clear old errors
        document.querySelectorAll(".text-danger").forEach(el => {
            el.innerHTML = "";
        });

        let form = this;
        let formData = new FormData(form);

        fetch("/api/contacts", {
            method: "POST",
            headers: {
                "Accept": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
            .then(async response => {

                let data = await response.json();

                if (!response.ok) {
                    throw data;
                }

                return data;
            })
            .then(data => {

                document.getElementById("responseMessage").innerHTML = `
            <div class="alert alert-success">
                ${data.message}
            </div>
        `;

                form.reset();

            })
            .catch(error => {

                // validation errors
                if (error.errors) {

                    Object.keys(error.errors).forEach(key => {

                        let errorElement = document.querySelector(".error-" + key);

                        if (errorElement) {
                            errorElement.innerHTML = error.errors[key][0];
                        }

                    });

                } else {

                    document.getElementById("responseMessage").innerHTML = `
                <div class="alert alert-danger">
                    Something went wrong!
                </div>
            `;
                }

            });

    });
</script>