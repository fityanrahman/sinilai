$(function(){

    $.ajaxSetup({
    type:"POST",
    url: "ambil_data",
    cache: false,
    });

    $("#kelas").change(function(){

        var value=$(this).val();
        if(value>0){
        $.ajax({
        data:{modul:'nama_siswa',id:value},
        success: function(respond){
        $("#siswa").html(respond);
        }
        })
        }
        
        });
        
})