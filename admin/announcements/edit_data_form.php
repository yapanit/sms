<!-- same as insert -->
<div class="form-group">
    <label>Title</label>
    <input type="text" name="title" id="title" class="form-control" />
</div>
<div class="form-group">
    <label>Description</label>
    <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
</div>

<!--  -->
<script>
    $(document).ready(function() {
        // add or change
        var title = localStorage.getItem('title');
        var description = localStorage.getItem('description');

        $('#title').val(title);
        $('#description').val(description);

    });
</script>