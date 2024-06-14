// Function to scroll to the top of the page
function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
}

// Show the scroll-to-top button when scrolling down
window.onscroll = function () {
  var button = document.getElementById('scroll-to-top');
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    button.style.display = 'block';
  } else {
    button.style.display = 'none';
  }
};

// the menu
function toggle() {
  let menu = document.querySelector(".menu-toggled");
  menu.style.display = 'block'; // Ensure the element is displayed before adding the 'active' class
  setTimeout(function () {
    menu.classList.add('active');
  }, 0);
}

function toggleBack() {
  let container = document.querySelector(".menu-toggled");
  container.classList.remove('active');
  container.addEventListener('transitionend', function () {
    container.style.display = 'none'; // Hide the element after the transition has ended
  }, {
    once: true
  });
}

/* document.addEventListener("DOMContentLoaded", () => {
  let isLoggedIn = localStorage.getItem("aastu");
  isLoggedIn = JSON.parse(isLoggedIn);

  if (!isLoggedIn || !isLoggedIn.isLoggedIn) {
    const logout = document.querySelector("#logout");
    const profile = document.querySelector("#profile");

    logout.style.display = "none";
    profile.style.display = "none";

    const discussionElements = document.querySelectorAll(".discussion1");
    for (const element of discussionElements) {
      element.style.display = "none";
    }

    const bookLinkElements = document.querySelectorAll(".book-link");
    for (const element of bookLinkElements) {
      element.style.display = "none";
    }

    

    
  } else {
    const aboutUs = document.querySelector("#about-h");
    const contactUs = document.querySelector("#contact-h");
    for (const element of document.querySelectorAll(".signin")) {
      element.style.display = "none";
    }
    for (const element of document.querySelectorAll(".register")) {
      element.style.display = "none";
    }
    aboutUs.style.display = "none";
    contactUs.style.display = "none";
  }
}) */

function logout() {
  localStorage.removeItem("aastu");
  window.location.replace("/auth_page/login.html");
}
