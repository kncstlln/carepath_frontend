function hideElementsAt1199px() {
    const elementsToHide = document.querySelectorAll('.col-2, .img3');
    const screenWidth = window.innerWidth;

    if (screenWidth <= 1199) {
      elementsToHide.forEach(element => {
        element.style.display = 'none';
      });
    } else {
      elementsToHide.forEach(element => {
        element.style.display = 'block'; // or 'flex' if using flexbox
      });
    }
  }

  // Call the function on page load
  hideElementsAt1199px();

  // Add an event listener to check on window resize
  window.addEventListener('resize', hideElementsAt1199px);