$(function(){
    $(document).on('click','.language',function(){
        var lang = $(this).attr('id');

        $.post('/site/language',{'lang': lang},function(data){
            location.reload();
        });
    });

    $(document).on('click', '#projectSearchReset', function() {
        // Clear form fields
        $('#projectsearch-text').val('');
        $('#projectsearch-id').val('');
        $('#projectsearch-added_date').val('');
        // Submit form fields
        $('#projectSearchForm').submit();

    });

    $(document).on('click', '#userSearchReset', function() {
        // Clear form fields
        $('#userdbsearch-id').val('');
        $('#userdbsearch-username').val('');
        $('#userdbsearch-email').val('');
        $('#userdbsearch-status').val('');
        // Submit form fields
        $('#userSearchForm').submit();

    });

    $(document).on('click', '.openModal', function() {
        var url = $(this).data('url');
        var modalTitle = $(this).data('modal-title');
        // AJAX request
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                // Set the title in the modal
                $('.globalModal .modal-header .modal-title').text(modalTitle);
                // Set the response as the body of the modal
                $('.globalModal .modal-body').html(response);
                // Open the modal
                $('.globalModal').modal('show');
            },
            error: function(xhr, status, error) {
                // Handle error if needed
                console.log(error);
            }
        });
    });

    $(document).on('submit', '.projectForm', function(event) {
            // Prevent the default form submission
            event.preventDefault();

            // Get the form data
            var formData = $(this).serialize();

            // Send an AJAX request
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Handle the successful response
                    console.log(response);
                    // Hide Modal
                    $('.globalModal').modal('hide');
                    // Reload the PJAX container
                    $.pjax.reload( '#projects');
                    // Show success notification
                    Swal.fire({
                        title: response.data,
                        icon: 'success',
                    });
                },
                error: function(xhr, status, error) {
                    toastr.error(xhr.responseText);

                    // Handle the error
                    console.log(xhr.responseText);
                    // Show an error message to the user or perform any necessary actions
                }
            });

    });

    $(document).on('click', '.switchStatusButton', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        var pjax = $(this).data('pjax');
        var title = $(this).data('title');
        var text = $(this).data('text');
        var confirm = $(this).data('confirmation');
        var cancel = $(this).data('cancelation');
        var ok = $(this).data('success');

        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: cancel,
            confirmButtonColor: '#ffd700',
            confirmButtonText: confirm
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'post',
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'There was an error with your request.' + xhr.responseText,
                            icon: 'error',
                        });
                    }
                }).done(function(response) {
                    Swal.fire({
                        title: response.data,
                        icon: 'success',
                        confirmButtonText: ok,
                    });
                    $.pjax.reload('#' + pjax);
                });
            }
        });
    });

    $(document).on('click', '.deleteButton', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        var pjax = $(this).data('pjax');
        var title = $(this).data('title');
        var text = $(this).data('text');
        var confirm = $(this).data('confirmation');
        var cancel = $(this).data('cancelation');

        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: cancel,
            confirmButtonColor: '#d33',
            confirmButtonText: confirm
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'post',
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'There was an error with your request.' + xhr.responseText,
                            icon: 'error',
                        });
                    }
                }).done(function(response) {
                    Swal.fire({
                        title: response.data,
                        icon: 'success',
                        confirmButtonText: 'OK',
                    });
                    $.pjax.reload('#' + pjax);
                });
            }
        });
    });

});