
<div class="done">
    <div class="preview">
        <img src="{{@PROTOCOL}}://{{@SERVER.HTTP_HOST}}/thumb/{{@name}}{{@ext}}" alt="" />
    </div>
    <div class="links fileinputs">
        <div class="formRow">
            <div class="formLabel">Direct link</div>
            <div class="formValue"><input type='text' value='{{@PROTOCOL}}://{{@SERVER.HTTP_HOST}}/img/{{@name}}{{@ext}}' onmouseover='this.select()' /></div>
        </div>
        <div class="formRow">
            <div class="formLabel">Thumbnail</div>
            <div class="formValue"><input type='text' value='{{@PROTOCOL}}://{{@SERVER.HTTP_HOST}}/thumb/{{@name}}{{@ext}}' onmouseover='this.select()' /></div>
        </div>
        <div class="formRow">
            <div class="formLabel">Thumb link <sup>HTML</sup></div>
            <div class="formValue"><input type='text' value='<a href="{{@PROTOCOL}}://{{@SERVER.HTTP_HOST}}/img/{{@name}}{{@ext}}"><img src="{{@PROTOCOL}}://{{@SERVER.HTTP_HOST}}/thumb/{{@name}}{{@ext}}" alt="" /></a>' onmouseover='this.select()' /></div>
        </div>
        <div class="formRow">
            <div class="formLabel">Thumb link <sup>BBCode</sup></div>
            <div class="formValue"><input type='text' value='[url={{@PROTOCOL}}://{{@SERVER.HTTP_HOST}}/img/{{@name}}{{@ext}}][img]{{@PROTOCOL}}://{{@SERVER.HTTP_HOST}}/thumb/{{@name}}{{@ext}}[/img][/url]' onmouseover='this.select()' /></div>
        </div>
        <div class="formRow">
            <div class="formLabel">Delete link</div>
            <div class="formValue"><input type='text' value='{{@PROTOCOL}}://{{@SERVER.HTTP_HOST}}/del/{{@name}}/{{@del}}' onmouseover='this.select()' /></div>
        </div>
    </div>
</div>

<br class="clearfix" />
