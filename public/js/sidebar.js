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


