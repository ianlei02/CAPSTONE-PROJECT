document.addEventListener("DOMContentLoaded", function () {
  const profilePic = document.querySelector(".navbar .profile");
  const dropdownMenu = document.getElementById("dropdownMenu");

  profilePic.addEventListener("click", function (e) {
    e.stopPropagation();
    dropdownMenu.classList.toggle("active");
  });
  document.addEventListener("click", function (e) {
    if (!profilePic.contains(e.target) && !dropdownMenu.contains(e.target)) {
      dropdownMenu.classList.remove("active");
    }
  });
  dropdownMenu.addEventListener("click", function (e) {
    e.stopPropagation();
  });
});
