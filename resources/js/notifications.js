Echo.private('App.Models.User.' + userId)
    .notification((notification) => {
        console.log(notification);

        // show toast here
        alert(notification.title);
    });