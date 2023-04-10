// Fungsi untuk mengubah nilai angka secara otomatis
function animateValue(id, start, end, duration) {
    var range = end - start;
    var current = start;
    var increment = end > start ? 1 : -1;
    var stepTime = Math.abs(Math.floor(duration / range));
    var obj = document.getElementById(id);
    var timer = setInterval(function() {
      current += increment;
      obj.innerHTML = current;
      if (current == end) {
        clearInterval(timer);
      }
    }, stepTime);
  }
  
  // Panggil fungsi untuk masing-masing angka
  animateValue("visitors", 0, 1200, 3000);
  animateValue("liked", 0, 1200, 3000);
  animateValue("propose", 0, 1200, 3000);
  animateValue("previews", 0, 1200, 3000);
  