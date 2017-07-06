tinymce.init({
    selector: '#myeditablediv',
    height: 450,
    language : "de",
    menubar: false,
    plugins: [
        "insertdatetime media table contextmenu paste imagetools textcolor image"
    ],
    toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | fontselect fontsizeselect | forecolor backcolor | bullist numlist outdent indent | image",
});
window.onload = function(){
    $tags = "";
    $('input').click(function() {
        if ($(this).is(':checked')) {
            $tags = $(this).attr('data-tag');
        }
    });

    // Post content and imagepath to "NewBlog.php"
    var btn = document.getElementById('SubmitBtn');
    btn.onclick = function(){
        var imagepath = $('#imagepath').val();
        if ($tags != "" && imagepath != "" ) {
            $.post( "NewBlog.php", { content : tinyMCE.activeEditor.getContent(), image : imagepath, tag : $tags, new : 'true' } );
        }
        else if ($tags != "" && imagepath == "") {
            $.post( "NewBlog.php", { content : tinyMCE.activeEditor.getContent(), tag : $tags, new : 'true' } );
        }
        else if ($tags == "" && imagepath == "") {
            $.post( "NewBlog.php", { content : tinyMCE.activeEditor.getContent(), new : 'true' } );
        }
        else {
            $.post( "NewBlog.php", { content : tinyMCE.activeEditor.getContent(), image : imagepath, new : 'true' } );
        }
        window.location = "http://localhost/blog/blog/Mail.php";
    };

    $('#mail').click(function() {
        Mail = prompt('Bitte geben Sie Ihre E-Mail Adresse ein:', '');
        Name = prompt('Bitte geben Sie Ihren Namen ein:', '');
        if (Mail && Name) {
            if (Mail != "" && Name != "") {
                alert(Name);
                $.post( "indexblog.php", { email : Mail, name : Name });
            }
        }
        if (Mail == "") {
            alert("Sie müssen Ihre E-Mail Adresse eingeben.");
        }
        if (Name == "") {
            alert("Sie müssen Ihren Namen eingeben.");
        }
    });

    $('.logout').click(function() {
        $.post( "CheckLogin.php", {logout: 'true'});
    });

};
