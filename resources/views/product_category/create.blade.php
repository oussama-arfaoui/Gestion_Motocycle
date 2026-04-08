{{Form::open(['url'=>'product_categorie','method'=>'post','enctype'=>'multipart/form-data', 'class'=>'needs-validation', 'novalidate'])}}

<div class="row">
    <div class="col-12">
        <div class="form-group">
            {{Form::label('name',__('Name'),['class'=>'form-label'])}}<x-required></x-required>
            {{Form::text('name',null,['class'=>'form-control','placeholder'=>__('Enter Product Category'),'required'=>'required'])}}
        </div>

        <div class="form-group">
            {{Form::label('brand_id', __('Brand'), ['class'=>'form-label'])}}
            {{ Form::select('brand_id', $brands->pluck('name','id'), null, ['class'=>'form-control','placeholder'=>__('Select Brand')]) }}
        </div>

        <div class="form-group">
            {{Form::label('parent_id', __('Parent Category'), ['class'=>'form-label'])}}
            {{ Form::select('parent_id', $parentCategories->pluck('name','id'), null, ['class'=>'form-control','placeholder'=>__('Select Parent Category')]) }}
        </div>

        <div class="form-group">
            <label for="categorie_img" class="form-label">{{ __('Upload Category Image') }}</label>
            <input type="file" name="categorie_img" id="categorie_img" class="form-control" onchange="document.getElementById('catImg').src = window.URL.createObjectURL(this.files[0])" multiple>
            <img id="catImg" src="" width="20%" class="mt-2"/>
        </div>
    </div>
</div>

<div class="form-group col-12 d-flex py-0 mb-0 justify-content-end form-label">
    <input type="button" value="{{__('Cancel')}}" class="btn btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn btn-primary ms-2">
</div>

{{Form::close()}}
