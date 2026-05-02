
  <title>Message Popups Only</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    #toastContainer {
      position: fixed;
      top: 1rem;
      right: 1rem;
      z-index: 1080;
    }
  </style>
</head>

<body class="bg-light">

  <div id="toastContainer"></div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


  
  <script src="script.js">
    const ROOT_URL = '< ?= ROOT_URL ?>';
  </script>



  <script>
  //   fetch('http://localhost/dev/witds/practicaltask/myblog/bootstrap/modals/get_messages.php')
  //     .then(response => {
  //       if (!response.ok) {
  //         throw new Error(`HTTP error! Status: ${response.status}`);
  //       }
  //       return response.json();
  //     })
  //     .then(messages => {
  //       console.log(messages); // For debugging
  //       messages.forEach(m => showToast(m)); // Display messages as toasts
  //     })
  //     .catch(error => {
  //       console.error('Error:', error);
  //       alert('Something went wrong while fetching the data.');
  //     });

  //   // Function to show toast messages
  //   function showToast(msg) {
  //     const toastEl = document.createElement('div');
  //     toastEl.className = 'toast align-items-start text-bg-light border shadow mb-2';
  //     toastEl.setAttribute('role', 'alert');
  //     toastEl.setAttribute('aria-live', 'assertive');
  //     toastEl.setAttribute('aria-atomic', 'true');

  //     toastEl.innerHTML = `
  //       <div class="d-flex">
  //         <div class="toast-body">
  //           <strong>${msg.title}</strong><br>
  //           <small class="text-muted">${msg.datetime}</small><br>
  //           ID: ${msg.id} | Name: ${msg.name}<br>
  //           ${msg.description}
  //         </div>
  //         <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  //       </div>
  //     `;

  //     document.getElementById('toastContainer').appendChild(toastEl);

  //     const bsToast = new bootstrap.Toast(toastEl, {
  //       delay: 50000
  //     });
  //     bsToast.show();

  //     toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
  //   }

  //   // Use absolute URL from root
  //   fetch('http://localhost/dev/witds/practicaltask/myblog/bootstrap/modals/get_messages.php')
  //     .then(response => {
  //       if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
  //       return response.json();
  //     })
  //     .then(messages => {
  //       console.log(messages); // For debugging
  //       messages.forEach(m => showToast(m)); // Display messages as toasts
  //     })
  //     .catch(error => {
  //       console.error('Error fetching messages:', error);
  //       alert('Something went wrong while fetching the data.');
  //     });

  //   // Toast display function
  //   function showToast(msg) {
  //     const toastEl = document.createElement('div');
  //     toastEl.className = 'toast align-items-start text-bg-light border shadow mb-2';
  //     toastEl.setAttribute('role', 'alert');
  //     toastEl.setAttribute('aria-live', 'assertive');
  //     toastEl.setAttribute('aria-atomic', 'true');

  //     toastEl.innerHTML = `
  //   <div class="d-flex">
  //     <div class="toast-body">
  //       <strong>${msg.title}</strong><br>
  //       <small class="text-muted">${msg.datetime}</small><br>
  //       ID: ${msg.id} | Name: ${msg.name}<br>
  //       ${msg.description}
  //     </div>
  //     <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  //   </div>
  // `;

  //     document.getElementById('toastContainer').appendChild(toastEl);

  //     const bsToast = new bootstrap.Toast(toastEl, {
  //       delay: 50000
  //     });
  //     bsToast.show();

  //     toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
  //   }
  // </script>



                                                