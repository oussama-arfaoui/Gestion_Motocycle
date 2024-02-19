<form action="/product" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <label for="product_name">Name</label>
            <input type="text" name="product_name" id="product_name">
        </div>
        <div class="col-md-6">
            <label for="product_description">description</label>
            <input type="text" name="product_description" id="product_description">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="status">status</label>
            <input type="text" name="status" id="status">
        </div>
        <div class="col-md-6">
            <label for="template">template</label>
            <input type="text" name="template" id="template">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="seo_title">seo_title</label>
            <input type="text" name="seo_title" id="seo_title">
        </div>
    </div>
    <div class="d-flex p-3 mb-2 bg-gray-200 justify-content-center">
        <img src="uploads/img/image_default.png" class="img-fluid img-maxsize-200 previewImage_image" />
    </div>
    <input class="form-control previewImage @error('image') is-invalid @enderror" type="file" name="image" value=""/>
    <button>save</button>
</form>