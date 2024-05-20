@php
    $jobcategories = App\Models\JobCategories::all();
    $carriercategories = App\Models\CarrierCategories::all();
@endphp

<section class="featured_article_style1 global_container">

    <div class="featured_article_style1-title">
        <x-blog-icon></x-blog-icon>
        <h2 class="featured_article_style1-title-h2">{{ $title }}</h2>
    </div>

    <div id="filtered_data">
        @foreach($Carrerss as $carrier)
        <div class="featured_article_style1-featured">          
            <div class="featured_article_style1-featured-text">
                <h3>{{ $carrier->title }}</h3>
                <p>description: {{ $carrier->description }}</p>
                <p>requirements: {{ $carrier->requirements }}</p>
                <p>location: {{ $carrier->location }}</p>
                <p>time: {{ $carrier->time }}</p>
                <p>jobCategory: {{ $carrier->jobCategory->name }}</p>
                <p>carrierCategory: {{ $carrier->carrierCategory->name }}</p>

                @if($carrier->is_job_offer)
                    <button text='I am applying' onclick="showApplicationForm('{{ $carrier->id }}')">I am applying</button>
                @endif

                <div class="applicationForm" id="applicationForm{{ $carrier->id }}" style="display: none;">
                    <form action="{{ route('jobapplication.userstore') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Hidden input for the carrier ID -->
                        <input type="hidden" name="career_id" value="{{ $carrier->id }}">

                        <div>
                            <label for="name">Name *</label>
                            <input type="text" name="name" required>
                        </div>
                        <div>
                            <label for="email">Email *</label>
                            <input type="email" name="email" required>
                        </div>
                        <div>
                            <label for="phone">Phone *</label>
                            <input type="text" name="phone" required>
                        </div>
                        <div>
                            <label for="cv">CV *</label>
                            <input type="file" name="cv" accept=".pdf" required>
                            <img class="cvPreview" src="#" alt="CV Preview" style="width: 24px; height: 24px;">
                        </div>
                        <div>
                            <label for="message">Message</label>
                            <textarea name="message"></textarea>
                        </div>
                        
                        <!-- Hidden input for the status (default: published) -->
                        <input type="hidden" name="status" value="published">

                        <div>
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        @endforeach
    </div>

    <script>
        // Function to display the job application form for a specific carrier
        function showApplicationForm(carrierId) {
            // Hide all existing application forms except the one for the selected carrier
            document.querySelectorAll('.applicationForm').forEach(function(form) {
                form.style.display = 'none';
            });
            document.getElementById('applicationForm' + carrierId).style.display = 'block';
        }
    
        // Function to handle file preview
        document.querySelectorAll('input[name="cv"]').forEach(function(cvInput) {
            cvInput.addEventListener('change', function() {
                var file = this.files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    cvInput.nextElementSibling.src = e.target.result;
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
    
</section>
