<form action="/product/edit" method="POST">
    @csrf
    <div class="row">
        <input type="text" name="id" id="id" value="{{ $product->id }}">
        <div class="col-md-6">
            <label for="product_name">Name</label>
            <input type="text" name="product_name" id="product_name" value="{{ $product->product_name }}">
        </div>
        <div class="col-md-6">
            <label for="product_description">description</label>
            <input type="text" name="product_description" id="product_description" value="{{ $product->product_description }}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="status">status</label>
            <input type="text" name="status" id="status" value="{{ $product->status }}">
        </div>
        <div class="col-md-6">
            <label for="template">template</label>
            <input type="text" name="template" id="template" value="{{ $product->template }}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="seo_title">seo_title</label>
            <input type="text" name="seo_title" id="seo_title" value="{{ $product->seo_title }}">
        </div>
    </div>
    <button>save</button>
</form>