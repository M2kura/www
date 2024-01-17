document.addEventListener('DOMContentLoaded', function() {
    var batchNumber = 0;

    function loadUsers() {
        fetch('fetch_users.php?batch=' + batchNumber)
            .then(response => response.text())  // Get the response as text
            .then(text => {
                console.log(text);  // Log the response text
                return JSON.parse(text);  // Parse the text as JSON
            })
            .then(users => {
                for (var i = 0; i < users.length; i++) {
                    var user = users[i];
                    var userElement = document.createElement('div');
                    userElement.className = 'user';
                    userElement.innerHTML = `
                        <div class="user-picture">
                            <img height="50px" width="50px" src="${user.profile_pic}" alt="Profile Picture">
                        </div>
                        <div class="user-info">
                            <div class="user-name">
                                <h2>${user.username}</h2>
                            </div>
                            <div class="user-profile">
                                <a href="profile.php?username=${user.username}">View Profile</a>
                            </div>
                        </div>
                    `;
                    document.querySelector('.users').appendChild(userElement);
                }
                batchNumber++;

                // Hide the load more button if there are no more users to load
                if (users.length < 5) {
                    document.getElementById('loadMore').style.display = 'none';
                }
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
                alert('There was an error loading more users. Please try again later.');
            });
    }

    // Load the first batch of users
    loadUsers();

    document.getElementById('loadMore').addEventListener('click', loadUsers);
});