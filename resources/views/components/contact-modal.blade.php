<div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Contact Us</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div id="formAlert"></div>

                <form id="contactForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" id="contact_name" name="name"
                            placeholder="Enter your name">
                        <div class="text-danger mt-1 d-none" id="nameError">Please enter your name.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="contact_email" name="email"
                            placeholder="Enter your email">
                        <div class="text-danger mt-1 d-none" id="emailError">Please enter a valid email address.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" id="contact_title" name="title"
                            placeholder="Enter a title">
                        <div class="text-danger mt-1 d-none" id="titleError">Please enter a title.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="contact_description" name="description" rows="4"
                            placeholder="Write your message"></textarea>
                        <div class="text-danger mt-1 d-none" id="descError">Please enter a description.</div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm w-100">Send Message</button>
                </form>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(function () {
            $('#contactForm').on('submit', function (e) {
                e.preventDefault();
                $('#nameError, #emailError, #titleError, #descError').addClass('d-none');
                $('#formAlert').html('');

                let data = {
                    _token: $('input[name="_token"]').val(),
                    name: $('#contact_name').val().trim(),
                    email: $('#contact_email').val().trim(),
                    title: $('#contact_title').val().trim(),
                    description: $('#contact_description').val().trim()
                };

                let valid = true;
                if (!data.name) { $('#nameError').removeClass('d-none'); valid = false; }
                if (!data.email || !/^\S+@\S+\.\S+$/.test(data.email)) { $('#emailError').removeClass('d-none'); valid = false; }
                if (!data.title) { $('#titleError').removeClass('d-none'); valid = false; }
                if (!data.description) { $('#descError').removeClass('d-none'); valid = false; }
                if (!valid) return;

                $.ajax({
                    url: "{{ route('contact.store') }}",
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    beforeSend() {
                        $('#contactForm button[type="submit"]').prop('disabled', true).text('Sending...');
                    },
                    success(response) {
                        if (response.success ?? response.status == 'success') {
                            $('#formAlert').html('<div class="alert alert-success">Message sent successfully!</div>');
                            $('#contactForm')[0].reset();
                            setTimeout(() => {
                                let modal = bootstrap.Modal.getInstance(document.getElementById('contactModal'));
                                if (modal) modal.hide();
                            }, 1500);
                        } else {
                            $('#formAlert').html('<div class="alert alert-danger">' + (response.message || 'Something went wrong.') + '</div>');
                        }
                    },
                    error(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors || {};
                            if (errors.name) $('#nameError').text(errors.name[0]).removeClass('d-none');
                            if (errors.email) $('#emailError').text(errors.email[0]).removeClass('d-none');
                            if (errors.title) $('#titleError').text(errors.title[0]).removeClass('d-none');
                            if (errors.description) $('#descError').text(errors.description[0]).removeClass('d-none');
                        } else {
                            $('#formAlert').html('<div class="alert alert-danger">Server error. Check console.</div>');
                            console.error(xhr.responseText);
                        }
                    },
                    complete() {
                        $('#contactForm button[type="submit"]').prop('disabled', false).text('Send Message');
                    }
                });
            });
        });
    </script>
@endpush