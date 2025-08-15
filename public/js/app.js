// document.addEventListener("DOMContentLoaded", () => {
//   const menuToggle = document.getElementById("menuToggle");
//   const navLinks = document.getElementById("navLinks");
//   const langSwitcher = document.querySelector(".lang-switcher");
//   const langOptions = document.querySelectorAll(".lang-options a");
window.addEventListener("scroll", () => {
  document
    .querySelector(".navigation1")
    .classList.toggle("scrolled", window.scrollY > 50);
});
//   // Menu toggle functionality
//   menuToggle.addEventListener("click", () => {
//     menuToggle.classList.toggle("open");
//     navLinks.classList.toggle("active");
//   });

//   // Language switcher functionality
//   langOptions.forEach((option) => {
//     option.addEventListener("click", (e) => {
//       e.preventDefault();
//       const selectedLang = option.getAttribute("data-lang");
//       langSwitcher.innerHTML = `${selectedLang.toUpperCase()} ▼`;
//       // Here you would typically change the language of the page
//       console.log(`Language changed to ${selectedLang}`);
//     });
//   });

//   // Close menu when clicking on a link (mobile)
//   navLinks.querySelectorAll("a").forEach((link) => {
//     link.addEventListener("click", () => {
//       if (window.innerWidth < 768) {
//         navLinks.classList.remove("active");
//         menuToggle.classList.remove("open");
//       }
//     });
//   });
// });
  // Menu toggle animation
        const menuToggle = document.getElementById("menuToggle");
        const menu = document.getElementById("menu");

        menuToggle.addEventListener("click", () => {
            menuToggle.classList.toggle("active");
            menu.classList.toggle("active");
        });

        // Langue switch
        const currentLang = document.getElementById("currentLang");
        const langOptions = document.getElementById("langOptions");
        const langLinks = langOptions.querySelectorAll("a");

        langLinks.forEach(link => {
            link.addEventListener("click", (e) => {
                e.preventDefault();
                const selectedLang = link.getAttribute("data-lang");
                currentLang.textContent = `${selectedLang} ▼`;
                // Optional: redirect to other language version
                // window.location.href = `/${selectedLang.toLowerCase()}/index.html`;
            });
        });



        // ************
        document.addEventListener("DOMContentLoaded", () => {
        //   const menuToggle = document.getElementById("menuToggle");
          const menu = document.getElementById("menu");
          const langSwitcher = document.getElementById("langSwitcher");
        //   const langOptions = document
        //     .getElementById("langOptions")
        //     .querySelectorAll("a");

          // Menu toggle functionality
        //   menuToggle.addEventListener("click", () => {
        //     menuToggle.classList.toggle("open");
        //     menu.classList.toggle("active");
        //   });

        //   // Language switcher functionality
        //   langOptions.forEach((option) => {
        //     option.addEventListener("click", (e) => {
        //       e.preventDefault();
        //       const selectedLang = option.getAttribute("data-lang");
        //       document.getElementById("currentLang").textContent =
        //         selectedLang + " ▼";
        //     });
        //   });

          // Close menu when clicking on a link (mobile)
          menu.querySelectorAll("a").forEach((link) => {
            link.addEventListener("click", () => {
              if (window.innerWidth < 992) {
                menu.classList.remove("active");
                menuToggle.classList.remove("open");
              }
            });
          });
        });
   