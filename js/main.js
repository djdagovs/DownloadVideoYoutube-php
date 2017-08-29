$(function(){
    $('select').material_select()
    $("#getVideo").on('click',function(){
        var link = $("#link").val(),
            type = $("input[name=typeVideo]:checked").val();
        if (type != 'video' && type != 'playlist'){type = 'video';}
        $(".view-links").addClass('heddin');

        if(link != ""){
            $("#getVideo .material-icons").addClass('heddin');
            $("#getVideo .fa").removeClass('heddin');
            $("#getLinks").attr('disabled','disabled');
            $("input").attr('disabled','disabled');
            
            $.post("include/ajax.downloadVideo.php",{type:type,link:link,getLink:false},function(data){
                $("#view-videos").html(data);
                 $('select').material_select();
                $("#getVideo .material-icons").removeClass('heddin');
                $("#getVideo .fa").addClass('heddin');
                $("#getLinks").removeAttr('disabled');
                $("input").removeAttr('disabled');
                $("select").on("change",function(){
                    $(this).parent().parent().parent().parent().children('a').attr('href',$(this).val())
                });
            });
        } 

    });

    $("#getLinks").on('click',function(){
        $(".view-links").addClass('heddin');
        var link = $("#link").val(),
            type = $("input[name=typeVideo]:checked").val();
        if (type != 'video' && type != 'playlist'){type = 'video';}

        if(link != ""){
            $("#getVideo").attr('disabled','disabled');
            $("input").attr('disabled','disabled');
            $("#getLinks .material-icons").addClass('heddin');
            $("#getLinks .fa").removeClass('heddin');
            $.post("include/ajax.downloadVideo.php",{type:type,link:link,getLink:true},function(data){
                $("textarea").val('');
                $("textarea").val(data);
                $(".view-links").removeClass('heddin');
                $("#getLinks .material-icons").removeClass('heddin');
                $("#getLinks .fa").addClass('heddin');        
                $("#getVideo").removeAttr('disabled','disabled');
                $("input").removeAttr('disabled','disabled');

            });
        }

    });

});