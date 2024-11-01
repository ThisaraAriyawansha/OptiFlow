document.addEventListener("DOMContentLoaded", function () {
    // Set the welcome message from local storage
    const userName = localStorage.getItem('userName');
    const welcomeMessage = document.getElementById('welcome-message');
    welcomeMessage.innerText = userName ? `Hello, ${userName}!` : 'Hello, Guest!';

    // Navigation between sections
    const links = document.querySelectorAll(".sidebar ul li a");
    const sections = document.querySelectorAll(".section-content");

    // Function to show the selected section
    function showSection(targetId) {
        // Hide all sections and remove 'active' class from them
        sections.forEach(section => {
            section.style.display = 'none'; // Use display property for visibility control
            section.classList.remove("active");
        });

        // Remove 'active-tab' class from all links
        links.forEach(link => link.classList.remove("active-tab"));

        // Show the target section and add 'active-tab' class to the clicked link
        const targetSection = document.getElementById(targetId);
        if (targetSection) {
            targetSection.style.display = 'block'; // Show the selected section
            targetSection.classList.add("active");
            const activeLink = document.querySelector(`a[href='#${targetId}']`);
            if (activeLink) {
                activeLink.classList.add("active-tab");
            }
        }
    }

    // Initialize by showing the dashboard section by default
    showSection('dashboard-section'); // Show the dashboard on load

    // Add click event listener to each link for navigation
    links.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            const targetId = link.id.replace("-link", "-section"); // Convert link ID to section ID
            showSection(targetId); // Call the function to show the selected section
        });
    });
});


