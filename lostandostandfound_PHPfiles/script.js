// scripts.js for Lost and Found System
document.addEventListener('DOMContentLoaded', () => {
    // Helper function to show messages
    const showMessage = (element, message, type = 'error') => {
        const messageDiv = element.querySelector('#form-messages');
        if (messageDiv) {
            messageDiv.className = `${type}-message`;
            messageDiv.textContent = message;
        }
    };

    // 2-register.html: Validate registration form
    const registerForm = document.querySelector('form[action="2-register.html"]');
    if (registerForm) {
        registerForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const username = registerForm.querySelector('#username').value;
            const email = registerForm.querySelector('#email').value;
            const password = registerForm.querySelector('#password').value;
            const confirmPassword = registerForm.querySelector('#confirm-password').value;

            if (!username || !email || !password || !confirmPassword) {
                showMessage(registerForm, 'Please fill out all fields.');
                return;
            }
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showMessage(registerForm, 'Please enter a valid email.');
                return;
            }
            if (password !== confirmPassword) {
                showMessage(registerForm, 'Passwords do not match.');
                return;
            }
            showMessage(registerForm, 'Registration successful!', 'success');
            // registerForm.submit(); // Uncomment when backend is ready
        });
    }

    // 3-login.html: Validate login form
    const loginForm = document.querySelector('form[action="3-login.html"]');
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const username = loginForm.querySelector('#username').value;
            const password = loginForm.querySelector('#password').value;
            const role = loginForm.querySelector('#role').value;

            if (!username || !password || role === '--Select Role--') {
                showMessage(loginForm, 'Please fill out all fields.');
                return;
            }
            showMessage(loginForm, 'Login successful!', 'success');
            // loginForm.submit(); // Uncomment when backend is ready
        });
    }

    // 6-user_profile.html: Validate profile update form
    const profileForm = document.querySelector('form[action="6-user_profile.html"]');
    if (profileForm) {
        profileForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const fullName = profileForm.querySelector('#full-name').value;
            const email = profileForm.querySelector('#email').value;
            const username = profileForm.querySelector('#username').value;

            if (!fullName || !email || !username) {
                showMessage(profileForm, 'Please fill out all required fields.');
                return;
            }
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showMessage(profileForm, 'Please enter a valid email.');
                return;
            }
            showMessage(profileForm, 'Profile updated successfully!', 'success');
            // profileForm.submit(); // Uncomment when backend is ready
        });
    }

    // 7-add_item.html: Validate add item form
    const addItemForm = document.querySelector('form[action="7-add_item.html"]');
    if (addItemForm) {
        addItemForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const name = addItemForm.querySelector('#name').value;
            const description = addItemForm.querySelector('#description').value;
            const location = addItemForm.querySelector('#location').value;
            const date = addItemForm.querySelector('#date').value;
            const photo = addItemForm.querySelector('#photo').files[0];

            if (!name || !description || !location || !date) {
                showMessage(addItemForm, 'Please fill out all required fields.');
                return;
            }
            if (photo && !['image/jpeg', 'image/png'].includes(photo.type)) {
                showMessage(addItemForm, 'Please upload a valid image (JPEG or PNG).');
                return;
            }
            showMessage(addItemForm, 'Item reported successfully!', 'success');
            // addItemForm.submit(); // Uncomment when backend is ready
        });
    }

    // 9-search_items.html: Validate search form
    const searchForm = document.querySelector('form[action="9-search_items.html"]');
    if (searchForm) {
        searchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const keyword = searchForm.querySelector('#keyword').value;
            if (!keyword) {
                showMessage(searchForm, 'Please enter a keyword to search.');
                return;
            }
            showMessage(searchForm, 'Search completed!', 'success');
            // Handle search results in Step 4
        });
    }

    // 10-delete_items.html: Validate delete form
    const deleteForm = document.querySelector('form[action="10-delete_items.html"]');
    if (deleteForm) {
        deleteForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const id = deleteForm.querySelector('#id').value;
            const name = deleteForm.querySelector('#name').value;

            if (!id && !name) {
                showMessage(deleteForm, 'Please provide an Item ID or Name.');
                return;
            }
            showMessage(deleteForm, 'Item deleted successfully!', 'success');
            // deleteForm.submit(); // Uncomment when backend is ready
        });
    }

    // 11-update_items.html: Validate update form
    const updateForm = document.querySelector('form[action="11-update_items.html"]');
    if (updateForm) {
        updateForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const name = updateForm.querySelector('#name').value;
            const description = updateForm.querySelector('#description').value;
            const date = updateForm.querySelector('#date').value;
            const location = updateForm.querySelector('#location').value;

            if (!name || !description || !date || !location) {
                showMessage(updateForm, 'Please fill out all required fields.');
                return;
            }
            showMessage(updateForm, 'Item updated successfully!', 'success');
            // updateForm.submit(); // Uncomment when backend is ready
        });
    }

    // 12-contact_us.html: Validate contact form
    const contactForm = document.querySelector('form[action="12-contact_us.html"]');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const name = contactForm.querySelector('#name').value;
            const email = contactForm.querySelector('#email').value;
            const message = contactForm.querySelector('#message').value;

            if (!name || !email || !message) {
                showMessage(contactForm, 'Please fill out all fields.');
                return;
            }
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showMessage(contactForm, 'Please enter a valid email.');
                return;
            }
            showMessage(contactForm, 'Message sent successfully!', 'success');
            // contactForm.submit(); // Uncomment when backend is ready
        });
    }
});


    // Mock data with picture field (replace with backend fetch later)
    const mockItems = [
        {
            id: 1,
            name: 'Black Wallet',
            location: 'Library',
            date: '2025-05-01',
            category: 'Accessories',
            picture: 'https://www.shutterstock.com/image-photo/top-view-new-black-genuine-600nw-1416621638.jpg'
        },
        {
            id: 2,
            name: 'Keys',
            location: 'Cafeteria',
            date: '2025-05-10',
            category: 'Others',
            picture: 'https://images.squarespace-cdn.com/content/v1/5eba27f35a793f6efa17541b/1591334996344-VL1XZ9RJVIGTCXFKCRBF/image-asset.jpeg'
        }
      
    ];
   


// 8-view_item.html: Display items with images
const itemsList = document.getElementById('items-list');
if (itemsList) {
    if (mockItems.length === 0) {
        itemsList.innerHTML = '<p class="error-message">No items found.</p>';
    } else {
        mockItems.forEach(item => {
            const itemCard = document.createElement('div');
            itemCard.className = 'item-card';
            itemCard.innerHTML = `
                <img src="${item.picture}" alt="${item.name}" class="item-image">
                <h3>${item.name}</h3>
                <p>Location: 📍 ${item.location}</p>
                <p>Date Found: 🗓️ ${item.date}</p>
                <a href="#" class="btn primary" data-id="${item.id}">Claim</a>
            `;
            itemCard.querySelector('a').addEventListener('click', (e) => {
                e.preventDefault();
                showMessage(itemsList, `Claimed item ${item.name}!`, 'success');
            });
            itemsList.appendChild(itemCard);
        });
    }
}

// 9-search_items.html: Handle search results with images
const searchForm = document.querySelector('form[action="9-search_items.html"]');
if (searchForm) {
    const searchResults = document.getElementById('search-results');
    searchForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const keyword = searchForm.querySelector('#keyword').value.toLowerCase();
        const category = searchForm.querySelector('#category').value;

        if (!keyword) {
            showMessage(searchForm, 'Please enter a keyword to search.');
            return;
        }

        const filteredItems = mockItems.filter(item =>
            item.name.toLowerCase().includes(keyword) &&
            (category === '--Select Category--' || item.category === category)
        );

        searchResults.innerHTML = '';
        if (filteredItems.length === 0) {
            searchResults.innerHTML = '<p class="error-message">No items found.</p>';
        } else {
            filteredItems.forEach(item => {
                const itemCard = document.createElement('div');
                itemCard.className = 'card';
                itemCard.innerHTML = `
                    <img src="${item.picture}" alt="${item.name}" class="item-image">
                    <h3>${item.name}</h3>
                    <p>Location: 📍 ${item.location}</p>
                    <p>Date Found: 🗓️ ${item.date}</p>
                `;
                searchResults.appendChild(itemCard);
            });
        }
        showMessage(searchForm, 'Search completed!', 'success');
    });
}