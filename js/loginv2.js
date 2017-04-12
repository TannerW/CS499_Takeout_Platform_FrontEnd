/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//-------THIS FILE WILL SOON BE DEPRECATED AND WILL BE IMPLEMENTED IN PHP-----
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

$(function () {
// this is the id of the form
    $("#loginForm").submit(function (e) {

        var url = "https://www.anderskitchen.com/api/session"; // the script where you handle the form input.

        var complex = $("#loginForm").serialize(); // name1=value1&name2=value2
        var json = toSimpleJson(complex); // {"name1":"value1", "name2":"value2"}
        var data = decodeURIComponent(JSON.stringify(json));
        json = JSON.parse(data);

        var store = store || {};

        /*
         * Sets the jwt to the store object
         */
        store.setJWT = function (data) {
            this.JWT = data;
        };

        /*
         * Submit the login form via ajax
         */

        $.ajax({
            type: "POST",
            url: url,
            data: json,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (data)
            {
                $.cookie("token", data["token"], {expires: 30, path: '/', domain: '.anderskitchen.com'}); // Sample 2
                //store.setJWT(data["token"]);
                //alert($.cookie("token"));

                $.ajax({
                    type: "GET",
                    url: "https://www.anderskitchen.com/api/me",
                    headers: {"Content-Type": "application/json", "Authorization": "JWT " + data["token"]},
                    dataType: "json",
                    success: function (data) {
                        switch (data["abilities"]) {
                            case "admin":
                                window.location.href = "https://www.anderskitchen.com/adminPortalSelect.php";
                                break;
                            case "chef":
                                window.location.href = "https://www.anderskitchen.com/ownerPortal.php";
                                break;
                            case "driver":
                                window.location.href = "https://www.anderskitchen.com/driverPortal.php";
                                break;
                            case "customer":
                                window.location.href = "https://www.anderskitchen.com/customerPortal.php";
                                break;
                            default:
                                window.location.href = "https://www.anderskitchen.com/customerPortal.php";
                                break;
                        }
                    }
                });
            }
        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
});