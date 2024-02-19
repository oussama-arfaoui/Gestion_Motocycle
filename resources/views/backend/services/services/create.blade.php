<form action="/service" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <label for="service_name">Name</label>
            <input type="text" name="service_name" id="service_name">
        </div>
        <div class="col-md-6">
            <label for="service_description">description</label>
            <input type="text" name="service_description" id="service_description">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="content">content</label>
            <input type="text" name="content" id="content">
        </div>
        <div class="col-md-6">
            <label for="is_featured">is_featured</label>
            <input type="text" name="is_featured" id="is_featured">
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-md-6">
            <label for="image">image</label>
            <input type="text" name="image" id="image">
        </div>
        <div class="col-md-6">
            <label for="status">status</label>
            <input type="text" name="status" id="status">
        </div>
    </div>
    <button>save</button>
</form>