<script>
    // Form öğelerini seç
    var form = document.getElementById('goform');
    var formElements = form.elements; // Tüm form öğelerini alır

    // Form öğelerini saklamak için bir nesne oluşturun
    var formValues = {};

    // Form öğelerinin başlangıç değerlerini alın
    for (var i = 0; i < formElements.length; i++) {
        var element = formElements[i];
        if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA' || element.tagName === 'SELECT') {
            formValues[element.name] = element.value;
        }
    }

    // Form öğeleri değiştiğinde tetiklenecek fonksiyon
    function inputChanged() {
        window.onbeforeunload = function() {
            for (var i = 0; i < formElements.length; i++) {
                var element = formElements[i];
                if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA' || element.tagName === 'SELECT') {
                    if (element.value !== formValues[element.name]) {
                        return 'Are you sure you want to leave this page? The entered data may be lost.';
                    }
                }
            }
        };
    }

    // Tüm form öğelerine "inputChanged" fonksiyonunu atama
    for (var j = 0; j < formElements.length; j++) {
        var element = formElements[j];
        if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA' || element.tagName === 'SELECT') {
            element.addEventListener('input', inputChanged);
        }
    }

    // Form gönderildiğinde uyarıyı kaldır
    form.addEventListener('submit', function() {
        window.onbeforeunload = null;
    });
</script>

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

    // CKEditor içeriği değiştiğinde tetiklenecek olay dinleyicisi
    CKEDITOR.instances.aciklama{{$localeCode}}.on('change', function() {
        window.onbeforeunload = function() {
            return 'Are you sure you want to leave this page? The entered data may be lost.';
        };
    });

    // CKEditor içeriği değiştiğinde tetiklenecek olay dinleyicisi
    CKEDITOR.instances.note{{$localeCode}}.on('change', function() {
        window.onbeforeunload = function() {
            return 'Are you sure you want to leave this page? The entered data may be lost.';
        };
    });

    // CKEditor içeriği değiştiğinde tetiklenecek olay dinleyicisi
    CKEDITOR.instances.short{{$localeCode}}.on('change', function() {
        window.onbeforeunload = function() {
            return 'Are you sure you want to leave this page? The entered data may be lost.';
        };
    });

    // Form gönderildiğinde uyarıyı kaldır
    document.querySelector('form').addEventListener('submit', function() {
        window.onbeforeunload = null;
    });




    @endforeach
</script>
