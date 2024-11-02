document.addEventListener("DOMContentLoaded", function () {
    const userName = localStorage.getItem('userName');
    const welcomeMessage = document.getElementById('welcome-message');
    welcomeMessage.innerText = userName ? `Hello, ${userName}!` : 'Hello, Guest!';

    const links = document.querySelectorAll(".sidebar ul li a");
    const sections = document.querySelectorAll(".section-content");

    function showSection(targetId) {
        sections.forEach(section => {
            section.style.display = 'none'; 
            section.classList.remove("active");
        });

        links.forEach(link => link.classList.remove("active-tab"));

        const targetSection = document.getElementById(targetId);
        if (targetSection) {
            targetSection.style.display = 'block'; 
            targetSection.classList.add("active");
            const activeLink = document.querySelector(`a[href='#${targetId}']`);
            if (activeLink) {
                activeLink.classList.add("active-tab");
            }
        }
    }

    showSection('dashboard-section'); 

    links.forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            const targetId = link.id.replace("-link", "-section"); 
            showSection(targetId); 
        });
    });
});


