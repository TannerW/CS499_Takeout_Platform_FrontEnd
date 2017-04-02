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

$(function () {
// this is the id of the form
    $("#loginForm").submit(function (e) {

        var url = "https://www.anderskitchen.com:9000/session"; // the script where you handle the form input.

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
                $.cookie("token", data["token"], {expires: 30, path: '/'}); // Sample 2
                //store.setJWT(data["token"]);
                alert($.cookie("token"));
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
});