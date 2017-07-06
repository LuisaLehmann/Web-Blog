$(document).ready(function() {
    $('.comment').click(function() {
        var getAtt = this.getAttribute('beitrag');
        $inputText = this.parentElement.firstChild.value;
        $.post( "Comment.php", { content : $inputText, beitragsid : getAtt} );
        window.location = "http://localhost/blog/blog/index.php";
    });

    $('#mail').click(function() {
        Mail = prompt('Bitte geben Sie Ihre E-Mail Adresse ein:', '');
        Name = prompt('Bitte geben Sie Ihren Namen ein:', '');
        if (Mail && Name) {
            if (Mail != "" && Name != "") {
                $.post( "Follow.php", { email : Mail, name : Name });
                window.location = "http://localhost/blog/blog/index.php";
            }
        }
        if (Mail == "") {
            alert("Sie müssen Ihre E-Mail Adresse eingeben.");
        }
        if (Name == "") {
            alert("Sie müssen Ihren Namen eingeben.");
        }
    });

    $('.like').click(function() {
        getAtt = this.getAttribute('beitrag');
        $count = parseInt(this.getAttribute('data-count'));
        $count = $count + 1;
        $.post("Like.php", {count_likes: $count, beitragsid : getAtt});
        window.location = "http://localhost/blog/blog/index.php";
    });

    $('.logout').click(function() {
        $.post( "CheckLogin.php", {logout: 'true'});
    });

});
