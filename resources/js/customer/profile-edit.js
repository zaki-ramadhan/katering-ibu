$(document).ready(function() {
    $('#foto_profile').change(function() {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#profile-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
});
