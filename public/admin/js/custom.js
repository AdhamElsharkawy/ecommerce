$(document).ready(function() {
    $('#current_password').on('keyup',function(){
        let current_password = $(this).val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '/admin/check-current-password',
                data: {current_password:current_password},
                success: function(response){
                    if(response == false){
                        $('#verify_current_pwd').html("<font color='red'>Current Password is Incorrect</font>");
                    }else if(response == true){
                        $('#verify_current_pwd').html("<font color='green'>Current Password is Correct</font>");
                    }
                },
                error: function(){
                    alert('Error');
                }
            });
    })
});