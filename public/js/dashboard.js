window.addEventListener('resize', function() {
    var image = document.querySelector('.aclogo');
    var windowWidth = window.innerWidth;
  
    if (windowWidth < 992) {
      image.style.display = 'none';
    } else {
      image.style.display = 'block';
    }
  });
  