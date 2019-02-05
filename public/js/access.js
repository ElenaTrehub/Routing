$(document).ready(function (){

        $('#AddAccessButton').click( function (){

        let name = $('#AddAccessInput').val();
        console.log('name', name);
        if(!/^[a-zа-я ]{4,50}$/i.test(name)){
            $('#successMessage').fadeOut(1000);
            $('#errorMessage').fadeOut(500);
            $('#errorInput').fadeIn(500).delay( 5000 ).fadeOut( 500 );
        }//if

        else{
            let url =`${window.paths.AjaxServerUrl}${window.paths.AddAccess}`;

            $.ajax({
                'url': url,
                'type':'POST',
                'data': {
                    'name': name,
                },
                'success': (data) => {

                    let accessId = +data.accessId;
                    let status = +data.code;
                    console.log('accessId', accessId);
                    if (status === 200 && accessId !== 0) {

                        $('#errorMessage').fadeOut(1000);
                        $('#successMessage').fadeIn(1000).delay(5000).fadeOut(500);
                        ;

                        $('#AccessesTable').append(`
                             <tr data-access-id = "${accessId}">
                                <td>${accessId}</td>
                                <td>${name}</td>
                                <td>
                                    <button data-access-id="${accessId}" data-genre-name="${name}" class="btn btn-danger" >Delete</button>
                                </td>
                                <td>
                                    <a  href="/EPCH/public/accesses/update_page/${accessId}"  class="btn btn-primary update" >Update</a>   
                                </td>
                            </tr>`
                        );
                    }//if
                    else {
                        $('#successMessage').fadeOut(1000);
                        $('#errorMessage').fadeIn(1000).delay(5000).fadeOut(500);

                    }//else
                }
            })
        }//else

    });

        $('body').on('click', '.btn-danger', function () {

        let accessID = +$(this).data('access-id');

        let accessTitle = $(this).data('access-name');

        let url = `${window.paths.AjaxServerUrl}${window.paths.DeleteAccess}`;

        $('#Modal').modal();
        $('#ModalTitle').text("Удаление");
        $('#ModalBody').html(`
            <h3>Delete!</h3>
            <div>Are you sure you want to remove the access level  <span style="font-weight: bold" id="nameAccess"></span>?</div>
        `);

        $('#nameAccess').text(accessTitle);

        $('#ConfirmButton').click(function () {
            $.ajax({
                'url': url,
                'type': 'POST',
                'data': {
                    'accessId': accessID
                },
                'success': (data) => {
                    console.log(data.res);
                    if (+data.code === 200) {

                        $(`tr[data-access-id=${accessID}]`).remove();

                    }//if

                }//success
            });

        });




    });

    $('#UpdateAccessButton').click( function (){

        let id = $(this).data('access-id');
        let name = $('#UpdateAccessInput').val();
        console.log('name', name);
        if(!/^[a-zа-я ]{4,50}$/i.test(name)){
            $('#successMessage').fadeOut(1000);
            $('#errorMessage').fadeOut(500);
            $('#errorInput').fadeIn(500).delay( 5000 ).fadeOut( 500 );
        }//if

        else{
            let url =`${window.paths.AjaxServerUrl}${window.paths.UpdateAccess}`;

            $.ajax({
                'url': url,
                'type':'POST',
                'data': {
                    'name': name,
                    'id': id,
                },
                'success': (data) => {

                    let accessId = +data.accessId;
                    let status = +data.status;
                    console.log('accessId', accessId);
                    console.log('status', status);
                    if (+status == 200 && accessId !== 0) {

                        $('#errorMessage').fadeOut(1000);
                        $('#successMessage').fadeIn(500).delay( 5000 ).fadeOut( 500 );;

                    }//if
                    else {
                        $('#successMessage').fadeOut(1000);
                        $('#errorMessage').fadeIn(500).delay( 5000 ).fadeOut( 500 );;
                    }//else
                }
            })
        }//else

    });


});