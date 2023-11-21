// Selecting the sidebar and buttons
const sidebar = document.querySelector(".sidebar");
const content = document.querySelector(".content");
const sidebarOpenBtn = document.querySelector("#sidebar-open");
const sidebarCloseBtn = document.querySelector("#sidebar-close");
const sidebarLockBtn = document.querySelector("#lock-icon");

// Function to toggle the lock state of the sidebar
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

// Function to hide the sidebar when the mouse leaves
const hideSidebar = () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.add("close");
    content.classList.remove("shifted");
  }
};

// Function to show the sidebar when the mouse enter
const showSidebar = () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.remove("close");
    content.classList.add("shifted");
  }
};

// Function to show and hide the sidebar
const toggleSidebar = () => {
  sidebar.classList.toggle("close");
};

document.addEventListener("DOMContentLoaded", () => {
    content.classList.add("shifted");
  });

// If the window width is less than 800px, close the sidebar and remove hoverability and lock
if (window.innerWidth < 800) {
  sidebar.classList.add("close");
  sidebar.classList.remove("locked");
  sidebar.classList.remove("hoverable");
  
}

// Adding event listeners to buttons and sidebar for the corresponding actions
sidebarLockBtn.addEventListener("click", toggleLock);
sidebar.addEventListener("mouseleave", hideSidebar);
sidebar.addEventListener("mouseenter", showSidebar);
sidebarOpenBtn.addEventListener("click", toggleSidebar);
sidebarCloseBtn.addEventListener("click", toggleSidebar);

// const sidebar = document.querySelector(".sidebar");
// const content = document.querySelector(".content");
// const sidebarOpenBtn = document.querySelector("#sidebar-open");
// const sidebarCloseBtn = document.querySelector("#sidebar-close");

// const hideSidebar = () => {
//   sidebar.classList.add("close");
//   content.classList.remove("shifted");
// };

// const showSidebar = () => {
//   sidebar.classList.remove("close");
//   content.classList.add("shifted");
// };

// const toggleSidebar = () => {
//   sidebar.classList.toggle("close");
//   content.classList.toggle("shifted");
// };

// document.addEventListener("DOMContentLoaded", () => {
//   sidebar.classList.add("close");
//   content.classList.remove("shifted");
// });

// sidebar.addEventListener("mouseleave", hideSidebar);
// sidebar.addEventListener("mouseenter", showSidebar);
// sidebarOpenBtn.addEventListener("click", toggleSidebar);
// sidebarCloseBtn.addEventListener("click", toggleSidebar);


