$(()=>{
    $('#submit').click(()=>{
        
        let datas = new FormData();

        datas.append('name', $('#name').val());
        datas.append('username', $('#username').val());
        datas.append('pass1', $('#pass1').val());
        datas.append('pass2', $('#pass2').val());
        datas.append('terms', $('#terms').val());

        $.ajax({
            url : $('#hidden_field').val(),
            type : 'POST',
            enctype : 'multipart/form-data',
            data : data,
            processData : false,
            contentType : false,
            cache : false,
            timeout : 600000,
            success : function(data){
                data.map((dat)=>{
                    // Here, we will send our data to the server in another ajax query
                    
                    let datas = new FormData();
                    datas.append('name', $('#name').val());
                    datas.append('username', $('#username').val());
                    datas.append('pass1', $('#pass1').val());
                    datas.append('pass2', $('#pass2').val());
                    datas.append('terms', $('#terms').val());

                    $.ajax({
                        url : $('#app_register_fan').val(),
                        type : 'POST',
                        enctype : 'multipart/form-data',
                        data : data,
                        processData : false,
                        contentType : false,
                        cache : false,
                        timeout : 600000,
                        success : function(data2){
                            data2.map((data)=>{
                                if(dat.message == 'ok'){
                                    return location.href = $('look_up').val();
                                }
                            }
                            )
                        }
                        
                    })

                })
            },
            error : function(respond){
                $('#error_msg').html('<div class="alert alert-danger"> ""The Username:"' + $('#username').val() + "is taken already" + "</div>");
            }

        })


    })
})

















// $(document).ready(function(){
//     var submit = document.getElementById('submit');

//     $('#submit').on('click', function submit() {
//         var error_msg = document.getElementById('error_msg');

//         // var name = document.getElementById('username').value;
//         // var name = document.getElementById('name').value;
//         // var name = document.getElementById('pass1').value;
//         // var name = document.getElementById('pass2').value;
//         // var name = document.getElementById('terms').value;


//         error_msg.innerHTML= '<div class="alert alert-danger"> ' + name + ' </div>';
        
//     });

   
//     })