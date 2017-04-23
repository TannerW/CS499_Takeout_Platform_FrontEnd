/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function toSimpleJson(serializedData) {
    var ar1 = serializedData.split("&");
    var json = "{";
    for (var i = 0; i < ar1.length; i++) {
        var ar2 = ar1[i].split("=");
        json += decodeURIComponent(i) > 0 ? ", " : "";
        json += "\"" + ar2[0] + "\" : ";
        json += "\"" + (ar2.length < 2 ? "" : ar2[1]) + "\"";
    }
    json += "}";
    return json;
}

function submitOrder(order_array, transaction_id)
        {
            console.log(order_array);
            var data = decodeURIComponent(JSON.stringify(order_array));
            var json = JSON.parse(data);
            var status;
            console.log(json);
        
        $.ajax({
                    type: "POST",
                    url: "https://www.anderskitchen.com/api/order",
                    headers: {"Content-Type": "application/json", "Authorization": "JWT " + $.cookie("token")},
                    data: json,
                    dataType: "json",
                    success: function (data) {
                        alert(data);
                        status = "success";
                        },
                        error: function(xhr, textStatus, errorThrown){
                            status = "failure";
                        }
                    });
                    
                    return status;
        }
