
<F3:check if="{{@ERROR}}">
    <div class="error">
        <p>{{@ERROR}}</p>
    </div>
</F3:check>

<div class="add">
    <form enctype="multipart/form-data" action="{{@BASE}}/add" method="post">
        <input type="file" name="image" id="image" />
        
        <input type="submit" name="submit" value="Upload" class="uploadBtn" />
    </form>
</div>
