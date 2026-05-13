<div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Contact Us</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

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


    document.addEventListener("DOMContentLoaded", () => {

    const form = document.getElementById("contactForm");
    const responseBox = document.getElementById("responseMessage");

    if (!form) return;

    form.onsubmit = async (e) => {
        e.preventDefault();


// /     form.addEventListener("submit", async (e) => {   //
    //         e.preventDefault();

        document.querySelectorAll(".text-danger")
            .forEach(el => el.innerHTML = "");

        responseBox.innerHTML = "";

        const formData = new FormData(form);

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')?.content;

        try {

            const response = await fetch("{{ url('/contacts') }}", {
                method: "POST",
                headers: {
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": csrfToken || ""
                },
                body: formData
            });

            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            responseBox.innerHTML = `
                <div class="alert alert-success">
                    ${data.message || "Message sent successfully!"}
                </div>
            `;

            form.reset();

        } catch (error) {

            if (error?.errors) {

                Object.entries(error.errors).forEach(([key, messages]) => {

                    const field = document.querySelector(".error-" + key);

                    if (field) {
                        field.innerHTML = messages[0];
                    }
                });

            } else {

                responseBox.innerHTML = `
                    <div class="alert alert-danger">
                        ${error?.message || "Something went wrong!"}
                    </div>
                `;
            }
        }
    };
});
</script>