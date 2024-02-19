<!-- Form for configuring hero shortcode -->
<section>
    <div class="node-input">
        <label class="control-label">Title</label>
        <input name="title" value="" class="form-control" />
    </div>

    <div class="node-input">
        <label class="control-label">Subtitle</label>
        <input name="subtitle" value="" class="form-control" />
    </div>

    <div class="node-input">
        <label class="control-label">Description</label>
        <textarea class="form-control" name="description" rows="3"></textarea>
    </div>

    <div class="node-input">
        <label class="control-label">Image</label>
        <input type="file" name="image" class="form-control" accept="image/*" /> <!-- Assuming you want to upload an image -->
    </div>


    <div class="node-input">
        <label class="control-label">Style</label>
        <select name="style" class="form-control">
            <option value="style1">Style 1</option>
            <option value="style2">Style 2</option>
        </select>
    </div>
</section>
