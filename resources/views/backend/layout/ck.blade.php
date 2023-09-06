<script type="text/javascript">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

    CKEDITOR.plugins.addExternal('youtube', '/backend/libs/ck/youtube/plugin.js');

        CKEDITOR.replace( 'aciklama{{$localeCode}}', {
        filebrowserUploadUrl: "{{ route('page.postUpload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form',
        extraPlugins: 'youtube',
            height : 500,
            toolbar: [
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold']},
                { name: 'paragraph',items: [ 'BulletedList']},
                { name: 'colors', items: [ 'TextColor' ]},
                { name: 'styles', items: [ 'Format', 'FontSize']},
                { name: 'links', items : [ 'Link', 'Unlink'] },
                { name: 'insert', items : [ 'Image', 'Table', 'Youtube']},
                { name: 'document', items : [ 'Source','Maximize' ]},
                { name: 'clipboard', items : [ 'PasteText', 'PasteFromWord' ]},
            ],
        });

    CKEDITOR.replace( 'note{{$localeCode}}', {
        filebrowserUploadUrl: "{{ route('page.postUpload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form',
        height : 500,
        toolbar: [
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold']},
            { name: 'paragraph',items: [ 'BulletedList']},
            { name: 'colors', items: [ 'TextColor' ]},
            { name: 'styles', items: [ 'Format', 'FontSize']},
            { name: 'links', items : [ 'Link', 'Unlink'] },
            { name: 'insert', items : [ 'Image', 'Table']},
            { name: 'document', items : [ 'Source','Maximize' ]},
            { name: 'clipboard', items : [ 'PasteText', 'PasteFromWord' ]},
        ],
    });


    CKEDITOR.replace( 'short{{$localeCode}}', {
        filebrowserUploadUrl: "{{ route('page.postUpload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form',
        height : 200,
        toolbar: [
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold']},
            { name: 'paragraph',items: [ 'BulletedList']},
            { name: 'colors', items: [ 'TextColor' ]},
            { name: 'styles', items: [ 'Format', 'FontSize']},
            { name: 'links', items : [ 'Link', 'Unlink'] },
            { name: 'insert', items : [ 'Image', 'Table']},
            { name: 'document', items : [ 'Source','Maximize' ]},
            { name: 'clipboard', items : [ 'PasteText', 'PasteFromWord' ]},
        ],
    });

    @endforeach
</script>
