window.Echo.private(`App.Models.User.${userId}`)
    .notification((notification) => {

        console.log(notification);

        const toast = document.createElement('div');

        toast.className =
            'toast align-items-center text-bg-success border-0 position-fixed top-0 end-0 m-3 show';

        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    ${notification.message}
                </div>
                <button type="button"
                    class="btn-close btn-close-white me-2 m-auto"
                    data-bs-dismiss="toast"></button>
            </div>
        `;

        document.body.appendChild(toast);

        new bootstrap.Toast(toast, {
            delay: 4000
        }).show();
    });