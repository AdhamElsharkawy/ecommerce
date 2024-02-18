<script>
    $(document).on("click", ".updateCmsPageStatus", function() {
        let status = $(this).find('i').attr('status');
        let page_id = $(this).attr('page_id');

        $.ajax({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type: 'post',
            url: '/admin/cms-pages/update-cms-page-status',
            data: {status: status, page_id: page_id},
            success: function(response) {
                if (response['status'] == 1) {
                    $('#page-' + page_id).html('<i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i>');
                } else {
                    $('#page-' + page_id).html('<i class="fas fa-toggle-off" style="color: grey" aria-hidden="true" status="Inactive"></i>');
                }
            },
            error: function() {
            }
        });
    });




</script>
