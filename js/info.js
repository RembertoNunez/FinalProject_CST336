$(document).ready(function(){
    var winrate_num=0;
    $.ajax({
        type : "GET",
        url : "averageWinrate.php",
        dataType: "json",
        data : {"winrateAvg" : winrate_num },
        success : function(data) {
            console.log(data);
            var status = "The Average Winrate is: " + data.winrateAvg;
            if(data) {
                $("#winResult").html(status);
            }
            else {
                $("#winResult").html(" ");
            }
        },
        complete: function(data, status) {
            
        }
    });
    var playrate_num = 0;
    $.ajax({
        type : "GET",
        url : "averagePlay.php",
        dataType: "json",
        data : {"playrateAvg" : playrate_num },
        success : function(data) {
            console.log(data);
            var status = "The Average Playrate is: " + data.playrateAvg;
            if(data) {
                $("#playResult").html(status);
            }
            else {
                $("#playResult").html(" ");
            }
        },
        complete: function(data, status) {
            
        }
    });
    var result_num= 0;
    $.ajax({
        type : "GET",
        url : "averageResult.php",
        dataType: "json",
        data : {"resultAvg" : result_num },
        success : function(data) {
            console.log(data);
            var status = "The Average Result is: " + data.resultAvg;
            if(data) {
                $("#avgResult").html(status);
            }
            else {
                $("#avgResult").html("Error");
            }
        },
        complete: function(data, status) {
            
        }
    });
});