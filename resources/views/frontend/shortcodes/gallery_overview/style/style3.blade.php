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
            <!-- Start of image repetition -->
            <img src="./projects/1.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/2.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/3.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/4.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/5.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/6.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/7.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/8.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/9.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/10.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/11.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/12.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/13.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/14.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/15.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/16.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/17.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/18.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/19.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/20.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/21.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/22.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/23.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/24.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/25.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/26.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/27.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/28.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/29.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/30.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/31.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/32.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/34.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/35.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/36.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/37.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/38.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/39.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/40.jpg" alt="img" onclick="openPopup(this)">
            <img src="./projects/41.jpg" alt="img" onclick="openPopup(this)">
            <!-- End of image repetition -->
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