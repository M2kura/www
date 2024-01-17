function searchUsers(query) {
    fetch('search.php?search=' + query)
        .then(response => response.json())
        .then(users => {
            var usersDiv = document.querySelector('.users');
            usersDiv.innerHTML = '';  // Clear the list of users

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
                usersDiv.appendChild(userElement);
            }
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
            alert('There was an error searching for users. Please try again later.');
        });
}

document.getElementById('searchForm').addEventListener('submit', function(event) {
    event.preventDefault();
    searchUsers(document.getElementById('searchInput').value);
});