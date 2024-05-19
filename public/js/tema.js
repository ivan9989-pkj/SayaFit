document.getElementById("themeButton").addEventListener("click", function() {
    document.body.classList.toggle("dark-theme");
    const themeIcon = document.getElementById("themeIcon");
    themeIcon.textContent = document.body.classList.contains("dark-theme") ? "🌜" : "🌞";
  });