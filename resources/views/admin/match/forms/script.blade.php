@section('plugin-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
@endsection

@section('plugin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
@endsection
@section('script')
    <script>

    function deleteBet(url) {
        if(confirm('Are you Sure ?')){
            window.location = url;
        }else{
            return false;
        }
    }
	$(document).on("click","#append",function(e){
		// i++;
		var id = $(this).data("id");
		var html = "<div class='row'>"
						+"<div class='col form-group'>"
							+"<label>Name</label>"
							+"<input type='text' name='name[]' class='form-control'>"
						+"</div>"
						+"<div class='col form-group'>"
							+"<label>Value</label>"
							+"<input type='text' name='value[]' class='form-control'>"
						+"</div>"
					+"</div>"
					// +"<button class='btn btn-sm'><i class='text-danger fa fa-times-circle '></i></button>"
					// console.log(html)
		$("#form-"+id).append(html)
	});

    $(document).on('change',"#correctBet",function(e){
        e.preventDefault();
        var id = $(this).data('id');

        $.confirm({
            icon:"fas fa-exclamation-triangle",
            title:"<h5 class='text-warning'>Warning!</h5>",
            content: "are you sure to set this as correct bet?",
            buttons:{
                Set:{
                btnClass: 'btn-warning',
                action: function(){
                    $('#actionForm-'+id).submit()
                    }
                },
                Cancel: function(){
                    // close pop up
                }
            }
        })
    });

    $(document).on('click','#publishResultButton',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.confirm({
            title: "<h5 class='text-danger'>Warning!</h5>",
            content: "Are you sure to publish the result?",
            buttons:{
                yes:{
                    btnClass: 'btn-success',
                    action:function(){
                        $('#publishResultForm-'+id).submit();
                    }
                },
                No:{
                    btnClass: 'btn-warning',
                    action:function(){
                        // do nothing
                    }
                }
            }
        })
    });

    $(document).on('click','#noResultButton',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.confirm({
            title: "<h5 class='text-danger'>Warning!</h5>",
            content: "Are you sure to publish the result?",
            buttons:{
                yes:{
                    btnClass: 'btn-success',
                    action:function(){
                        $('#noResultForm-'+id).submit();
                    }
                },
                No:{
                    btnClass: 'btn-warning',
                    action:function(){
                        // do nothing
                    }
                }
            }
        })
    });

    $(document).on('click','#betStatusButton',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('#betStatusForm-'+id).submit();
        // var status = $(this).data('status');
        // var icon = "";
        // var title = "";
        // var content = "";
        // if(status == "on"){
        //     icon = "fas fa-skull-crossbones";
        //     title = "<h5 class=text-danger>Caution!</h5>";
        //     content = "Disabling this will not allow users to bet on this option. Do you want to continue ?";
        // }else{
        //    icon = "fas fa-exclamation";
        //     title = "<h5 class=text-warning>Warning!</h5>";
        //     content = "Enabling this will allow users to bet on this option. Do you want to continue ?"; 
        // }
        // $.confirm({
        //     icon: icon,
        //     title: title,
        //     content: content,
        //     buttons:{
        //         yes:{
        //             btnClass: 'btn-success',
        //             action:function(){
        //                 $('#betStatusForm-'+id).submit();
        //             }
        //         },
        //         No:{
        //             btnClass: 'btn-warning',
        //             action:function(){
        //                 // do nothing
        //             }
        //         }
        //     }
        // })
    });

    

</script>
@endsection