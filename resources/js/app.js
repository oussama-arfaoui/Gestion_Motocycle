const hero_slider_counter = 8000;


// Code for functioning Dropdowns

const dropdowns = ["nav-products", "nav-ecommerce", "username"];

for (let element of dropdowns) {
    const dropdownButton = document.getElementById(`dropdown-${element}`);
    const dropdownContent = document.getElementById(`dropdown-menu-${element}`);

    if (dropdownButton && dropdownContent) {
        dropdownButton.addEventListener('click', () => {
            dropdownContent.classList.toggle('show');
            dropdownContent.classList.toggle('hide');
            // Toggle the arrow direction as well
            const arrow = document.getElementById(`dropdown-${element}-arrow`);
            arrow.classList.toggle('spin-arrow');
        });
    }
};


// /// Code for functioning automatic hero-slider

// document.addEventListener("DOMContentLoaded", function () {
//     const carousel = document.querySelector(".hero__carousel");
//     const carouselItems = document.querySelector(".carousel-items");
//     const carouselWidth = carousel.clientWidth;
//     let currentIndex = 0;
//     let intervalId;

//     function showSlide(index) {
//         const offset = -index * carouselWidth;
//         carouselItems.style.transform = `translateX(${offset}px)`;
//     }

//     function nextSlide() {
//         currentIndex = (currentIndex + 1) % carouselItems.children.length;
//         showSlide(currentIndex);
//         resetInterval();
//     }

//     function prevSlide() {
//         currentIndex = (currentIndex - 1 + carouselItems.children.length) % carouselItems.children.length;
//         showSlide(currentIndex);
//         resetInterval();
//     }

//     function resetInterval() {
//         clearInterval(intervalId);
//         intervalId = setInterval(nextSlide, hero_slider_counter);
//     }

//     // Initial setup
//     showSlide(currentIndex);
//     resetInterval();

//     // Automatic carousel advance every 8 seconds
//     intervalId = setInterval(nextSlide, hero_slider_counter);

//     // Event listeners for next and previous buttons
//     document.querySelector(".prev").addEventListener("click", function(event) {
//         event.preventDefault(); // Prevents text selection
//         prevSlide();
//         clearInterval(intervalId); // Disable auto-scrolling
//     });
//     document.querySelector(".next").addEventListener("click", function(event) {
//         event.preventDefault(); // Prevents text selection
//         nextSlide();
//         clearInterval(intervalId); // Disable auto-scrolling
//     });
// })

function generateForms() {
    var selectedTab = document.getElementById("tabs").value;
    var dynamicForms = document.getElementById("dynamicForms");
    dynamicForms.innerHTML = "";

    for (var i = 1; i <= selectedTab; i++) {
        dynamicForms.innerHTML += `
                <div class="form-group">
                    <label class="control-label">Title ${i}</label>
                    <input name="title_${i}" value="" class="form-control" />
                </div>

                <div class="form-group">
                    <label class="control-label">Subtitle ${i}</label>
                    <input name="subtitle_${i}" value="" class="form-control" />
                </div>

                <div class="form-group">
                    <label class="control-label">Description ${i}</label>
                    <textarea class="form-control" name="description_${i}" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label class="control-label">Button Primary Label ${i}</label>
                    <input name="button_primary_label_${i}" value="" class="form-control" />
                </div>

                <hr>
            `;
    }
}