// document.addEventListener("DOMContentLoaded", () => {
//   const menuToggle = document.getElementById("menuToggle");
//   const navLinks = document.getElementById("navLinks");
//   const langSwitcher = document.querySelector(".lang-switcher");
//   const langOptions = document.querySelectorAll(".lang-options a");
window.addEventListener("scroll", function () {
  const nav = document.querySelector(".navigation1");
  if (window.scrollY > 0) {
    nav.classList.add("white");
  } else {
    nav.classList.remove("white");
  }
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

                // Créer un formulaire pour envoyer la requête POST
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/locale/change';

                // Ajouter le token CSRF
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);

                // Ajouter la locale
                const localeInput = document.createElement('input');
                localeInput.type = 'hidden';
                localeInput.name = 'locale';
                localeInput.value = selectedLang;
                form.appendChild(localeInput);

                // Soumettre le formulaire
                document.body.appendChild(form);
                form.submit();
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
   