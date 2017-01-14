/**
 * Created by James Singizi on 1/11/2017.
 * 
 */

$(function () {

    $('.delete_comment').click(function (event) {
        event.preventDefault();
        var id = $(this).attr('data-id');
        var elementId = $(this).attr('id');

        var r=confirm("Are you sure you want to delete this comment");
        if(r==true){

            //send to the deleting file

            $.ajax({
                url: 'delete_comment.php?id='+id,
                beforeSend: function(){
                    $('#'+elementId).html('Deleting...')
                },

                success: function(data){
                   // var dataObj = jQuery.parseJSON(data);
                   var dataObj =data;

                    if(dataObj.message=='success'){
                        alert('Comment deleted successfully');
                        location.reload();
                    }else{
                        alert('Comment could not be deleted, please reload this page and try again');
                    }
                }
            });
        }

    });


    //authorise comment
    $('.authorise_comment').click(function (event) {
        event.preventDefault();
        var id = $(this).attr('data-id');
        var elementId = $(this).attr('id');

        var r=confirm("Are you sure you want to authorise this comment");
        if(r==true){

            //send to the authorising file

            $.ajax({
                url: 'authorize_comment.php?id='+id,
                beforeSend: function(){
                    $('#'+elementId).html('Authorizing...')
                },

                success: function(data){
                    // var dataObj = jQuery.parseJSON(data);
                    var dataObj =data;

                    if(dataObj.message=='success'){
                        alert('Comment authorised successfully');
                        location.reload();
                    }else{
                        alert('Comment could not be authorised, please reload this page and try again');
                    }
                }
            });
        }

    });

    //suppress comment
    $('.suppress_comment').click(function (event) {
        event.preventDefault();
        var id = $(this).attr('data-id');
        var elementId = $(this).attr('id');
        var status = $(this).attr('data-status');

        var r=confirm("Are you sure you want to update this comment");
        if(r==true){

            //send to the suppressing file

            $.ajax({
                url: 'suppress_comment.php?id='+id+'&status='+status,
                beforeSend: function(){
                    $('#'+elementId).html('Working...')
                },

                success: function(data){
                    // var dataObj = jQuery.parseJSON(data);
                    var dataObj =data;

                    if(dataObj.message=='success'){
                        alert('Comment updated successfully');
                        location.reload();
                    }else{
                        alert('Comment could not be updated, please reload this page and try again');
                    }
                }
            });
        }

    });

});