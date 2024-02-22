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

//     // Mouse gesture handling
//     let startX = 0;
//     let isDragging = false;

//     function handleMouseDown(event) {
//         isDragging = true;
//         startX = event.clientX;
//         clearInterval(intervalId);
//         event.preventDefault(); // Prevents text selection
//     }

//     function handleMouseMove(event) {
//         if (!isDragging) return;
//         const distance = event.clientX - startX;
//         const threshold = carouselWidth * 0.2; // Adjust as needed
//         if (Math.abs(distance) >= threshold) {
//             if (distance > 0) {
//                 prevSlide();
//             } else {
//                 nextSlide();
//             }
//             isDragging = false;
//         }
//         event.preventDefault(); // Prevents text selection
//     }

//     function handleMouseUp() {
//         isDragging = false;
//         resetInterval();
//     }

//     document.addEventListener("mousedown", handleMouseDown);
//     document.addEventListener("mousemove", handleMouseMove);
//     document.addEventListener("mouseup", handleMouseUp);
// });
