function validateForm() {
    var userName = document.getElementById("userName").value;
    var password = document.getElementById("password").value;

    var usernameError = document.getElementById("usernameError");
    var passwordError = document.getElementById("passwordError");


    usernameError.style.display = "none";
    passwordError.style.display = "none";

    var isValid = true;

    if (userName === "") {
        usernameError.style.display = "block";
        isValid = false;
    }

    if (password === "") {
        passwordError.style.display = "block";
        isValid = false;
    }

    if (isValid) {
        alert("Form submitted successfully!");
    }
}

function hideElementsAt1199px() {
    const elementsToHide = document.querySelectorAll('.col-2, .img3');
    const screenWidth = window.innerWidth;

    if (screenWidth <= 1199) {
      elementsToHide.forEach(element => {
        element.style.display = 'none';
      });
    } else {
      elementsToHide.forEach(element => {
        element.style.display = 'block';
      });
    }
  }


  hideElementsAt1199px();
  window.addEventListener('resize', hideElementsAt1199px);

  const sidebar = document.querySelector(".sidebar");
  const content = document.querySelector(".content");
  const sidebarOpenBtn = document.querySelector("#sidebar-open");
  const sidebarCloseBtn = document.querySelector("#sidebar-close");
  const sidebarLockBtn = document.querySelector("#lock-icon");
  
  const toggleLock = () => {
    sidebar.classList.toggle("locked");
  
    if (!sidebar.classList.contains("locked")) {
      sidebar.classList.add("hoverable");
      sidebarLockBtn.classList.replace("bx-lock-alt", "bx-lock-open-alt");
    } else {
      sidebar.classList.remove("hoverable");
      sidebarLockBtn.classList.replace("bx-lock-open-alt", "bx-lock-alt");
    }
  };
  
  const hideSidebar = () => {
    if (sidebar.classList.contains("hoverable")) {
      sidebar.classList.add("close");
      content.classList.remove("shifted");
    }
  };
  
  
  const showSidebar = () => {
    if (sidebar.classList.contains("hoverable")) {
      sidebar.classList.remove("close");
      content.classList.add("shifted");
    }
  };
  
  
  const toggleSidebar = () => {
    sidebar.classList.toggle("close");
  };
  
  document.addEventListener("DOMContentLoaded", () => {
      content.classList.add("shifted");
    });
  
  
  if (window.innerWidth < 800) {
    sidebar.classList.add("close");
    sidebar.classList.remove("locked");
    sidebar.classList.remove("hoverable");
    
  }
  
  sidebarLockBtn.addEventListener("click", toggleLock);
  sidebar.addEventListener("mouseleave", hideSidebar);
  sidebar.addEventListener("mouseenter", showSidebar);
  sidebarOpenBtn.addEventListener("click", toggleSidebar);
  sidebarCloseBtn.addEventListener("click", toggleSidebar);
  
  
window.addEventListener('resize', function() {
var image = document.querySelector('.aclogo');
var windowWidth = window.innerWidth;

if (windowWidth < 992) {
    image.style.display = 'none';
} else {
    image.style.display = 'block';
}
});
  
  
  



