<!-- Form for configuring hero shortcode -->
<section>
    <div class="form-group">
        <label class="control-label">Title</label>
        <input name="title" value="" class="form-control" />
    </div>

    <div class="form-group">
        <label class="control-label">Subtitle</label>
        <input name="subtitle" value="" class="form-control" />
    </div>

    <div class="form-group">
        <label class="control-label">Description</label>
        <textarea class="form-control" name="description" rows="3"></textarea>
    </div>

    <div class="form-group">
        <label class="control-label">Button Primary Label</label>
        <input name="button_primary_label" value="" class="form-control" />
    </div>

    <div class="form-group">
        <label class="control-label">TABS</label>
        <select id="tabs" class="form-control" onchange="generateForms()">
            <?php
            // Number of options you want
            $limit = 10;

            // Generating options using a loop
            for ($i = 1; $i <= $limit; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>
    </div>

    <div id="dynamicForms"></div>

    <div class="form-group">
        <label class="control-label">Style</label>
        <select name="style" class="form-control">
            <option value="style1">Style 1</option>
            <option value="style2">Style 2</option>
        </select>
    </div>
</section>