<section class="gallery_overview_style3 global_container">
    <div class="gallery_overview_style3-content">
        <div class="gallery_overview_style3-content-text">

            <div class="gallery_overview_style3-content-text-tag">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m16.2 19 4.8-7-4.8-7H3l4.8 7L3 19h13.2Z" />
                </svg>
                <p>{{$section_tag}}</p>
            </div>
            <h2 class="gallery_overview_style3-content-text-title">{{$title}}</h2>
            <p class="gallery_overview_style3-content-text-description">{{$description}}</p>
        </div>

        <div class="gallery_overview_style3-content-collection">
            <img src="./blanks/1000x500.png" alt="img" onclick="openPopup(this)">
            <img src="./blanks/1000x500.png" alt="img" onclick="openPopup(this)">
            <img src="./blanks/1000x500.png" alt="img" onclick="openPopup(this)">
            <img src="./blanks/1000x500.png" alt="img" onclick="openPopup(this)">
            <img src="./blanks/1000x500.png" alt="img" onclick="openPopup(this)">
            <img src="./blanks/1000x500.png" alt="img" onclick="openPopup(this)">
            <img src="./blanks/1000x500.png" alt="img" onclick="openPopup(this)">
            <img src="./blanks/1000x500.png" alt="img" onclick="openPopup(this)">
            <img src="./blanks/1000x500.png" alt="img" onclick="openPopup(this)">
            <img src="./blanks/1000x500.png" alt="img" onclick="openPopup(this)">
            <img src="./blanks/1000x500.png" alt="img" onclick="openPopup(this)">
            <img src="./blanks/1000x500.png" alt="img" onclick="openPopup(this)">
        </div>

    </div>
</section>

<div id="imagePopup" class="project_popup">
    <img id="popupImage" src="" alt="Popup Image">
</div>


<script>
    function openPopup(img) {
    // Get the source attribute of the clicked image
    var imgSrc = img.src;
    
    // Set the source attribute of the image in the popup
    document.getElementById("popupImage").src = imgSrc;

    
    // Show the popup
    document.getElementById("imagePopup").style.display = "block";
    }
    
    // Close the popup when clicking outside the image
    window.onclick = function(event) {
    var popup = document.getElementById("imagePopup");
    if (event.target == popup) {
    popup.style.display = "none";
    }
    }
</script>