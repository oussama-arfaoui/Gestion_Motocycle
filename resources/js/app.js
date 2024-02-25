const dropdowns = ["nav-products", "nav-ecommerce", "username"];

for (let element of dropdowns) {
    const dropdownButton = document.getElementById(`dropdown-${element}`);
    const dropdownContent = document.getElementById(`dropdown-menu-${element}`);

    dropdownButton.addEventListener('click', () => {
        dropdownContent.classList.toggle('show');
        dropdownContent.classList.toggle('hide');
        // Toggle the arrow direction as well
        const arrow = document.getElementById(`dropdown-${element}-arrow`);
        arrow.classList.toggle('spin-arrow');
    });
}

// $(document).ready(function () {
//     "use strict";
//     $('.previewImage ').on("change", function () {
//         var image = this.files[0],
//             type = $(this).attr("name");
//         // VALIDATE IF IT'S JPEG, JPG OR PNG FORMAT
//         if (image["type"] == "image/jpeg" || image["type"] == "image/jpg" || image["type"] == "image/png") {
//             var dataImage = new FileReader();
//             dataImage.readAsDataURL(image);
//             $(dataImage).on("load", function (event) {
//                 var routeImage = event.target.result;
//                 $(".previewImage_" + type).attr("src", routeImage);
//             });
//         }
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

