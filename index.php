<html>
    <head>
        <title>Sign Up Form</title>
        <style>
            @import url("styles.css");
        </style>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script>
            function getCityInfo() {
                //alert($("#zip").val());
                $.ajax({
                    type: "get",
                    url: "http://hosting.otterlabs.org/laramiguel/ajax/zip.php?zip_code=",
                    dataType: "json",
                    data: {
                        "zip_code": $("#zip").val()
                        
                    },
                    success: function(data,status) {
                        console.log(data + 1);
                        debugger
                        $('#zipper').html("");
                        if (!data.city) {
                            $('#zipper').html("Please Enter a Valid Zip Code");
                            $("#city").html("");
                            $("#lat").html("");
                            $("#lon").html("");
                        }
                        else {
                            $("#city").html(data.city);
                            $("#lat").html(data.latitude);
                            $("#lon").html(data.longitude);
                        }
                        
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                         //alert(status);
                    }
                });
            }
            
            function getCountyInfo() {
                $.ajax({
                    type: "get",
                    url: "http://hosting.otterlabs.org/laramiguel/ajax/countyList.php",
                    dataType: "json",
                    data: {
                      "state": $("#stateList").val()
                    },
                    success: function(data,status) {
                        $("#county-list").html("");
                        for(var i =0; i <data.counties.length - 1; i++) {
                            $("#county-list").append("<option>" + data.counties[i].county + "</option>");
                        }
                      },
                    complete: function(data,status) { //optional, used for debugging purposes
                         //alert(status);
                    }
                });
            }
            function validateUsername() {
                //alert("Invalid Username: " + $("#username").val());
                $.ajax({
                    type: "get",
                    url: "api.php",
                    dataType: "json",
                    data: {
                        'username': $('#username').val(),
                        'action': 'validate-username'
                    },
                    success: function(data,status) {
                        if (data.length > 0) {
                            document.getElementById("username-valid").style.color = "red";
                            $('#username-valid').html("Username is not available"); 
                        } else {
                            document.getElementById("username-valid").style.color = "green";
                            $('#username-valid').html("Username is available");
                        }
                        
                      },
                    complete: function(data,status) { //optional, used for debugging purposes
                         //alert(status);
                    }
                });
            }
            
        </script>
    </head>
    <body>
       <h1> Sign Up Form </h1>
       <div id="box">
        <form onsubmit="return false;">
            <fieldset>
               <legend>Sign Up</legend>
                First Name:  <input type="text"><br> 
                Last Name:   <input type="text"><br> 
                Email:       <input type="text"><br> 
                Phone Number:<input type="text"><br><br>
                Zip Code:    <input onchange="getCityInfo();" type="text" id="zip"><span id="zipper"></span><br>
                City: <span id="city"></span>
                <br>
                Latitude: <span id="lat"></span>
                <br>
                Longitude: <span id="lon"></span>
                <br><br>
                State: <select onchange="getCountyInfo();" id="stateList" name="stateList">
                    <option value="1">Select Option</option>
                    <option value="AL">Alabama</option>
                	<option value="AK">Alaska</option>
                	<option value="AZ">Arizona</option>
                	<option value="AR">Arkansas</option>
                	<option value="CA">California</option>
                	<option value="CO">Colorado</option>
                	<option value="CT">Connecticut</option>
                	<option value="DE">Delaware</option>
                	<option value="FL">Florida</option>
                	<option value="GA">Georgia</option>
                	<option value="HI">Hawaii</option>
                	<option value="ID">Idaho</option>
                	<option value="IL">Illinois</option>
                	<option value="IN">Indiana</option>
                	<option value="IA">Iowa</option>
                	<option value="KS">Kansas</option>
                	<option value="KY">Kentucky</option>
                	<option value="LA">Louisiana</option>
                	<option value="ME">Maine</option>
                	<option value="MD">Maryland</option>
                	<option value="MA">Massachusetts</option>
                	<option value="MI">Michigan</option>
                	<option value="MN">Minnesota</option>
                	<option value="MS">Mississippi</option>
                	<option value="MO">Missouri</option>
                	<option value="MT">Montana</option>
                	<option value="NE">Nebraska</option>
                	<option value="NV">Nevada</option>
                	<option value="NH">New Hampshire</option>
                	<option value="NJ">New Jersey</option>
                	<option value="NM">New Mexico</option>
                	<option value="NY">New York</option>
                	<option value="NC">North Carolina</option>
                	<option value="ND">North Dakota</option>
                	<option value="OH">Ohio</option>
                	<option value="OK">Oklahoma</option>
                	<option value="OR">Oregon</option>
                	<option value="PA">Pennsylvania</option>
                	<option value="RI">Rhode Island</option>
                	<option value="SC">South Carolina</option>
                	<option value="SD">South Dakota</option>
                	<option value="TN">Tennessee</option>
                	<option value="TX">Texas</option>
                	<option value="UT">Utah</option>
                	<option value="VT">Vermont</option>
                	<option value="VA">Virginia</option>
                	<option value="WA">Washington</option>
                	<option value="WV">West Virginia</option>
                	<option value="WI">Wisconsin</option>
                	<option value="WY">Wyoming</option>
                </select>
                Select a County: <select id=county-list></select><br>
                
                Desired Username: <input onchange="validateUsername();" id="username" type="text"><span id="username-valid"></span><br>
                Password: <input type="password"><br>
                Type Password Again: <input type="password"><br>
                <input type="submit" value="Sign up!">
            </fieldset>
        </form>
        </div>
    </body>
</html>