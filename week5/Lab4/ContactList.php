<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <textarea id="DEBUG"></textarea>
        
        
        <h1> Contacts List </h1>
        
        <button id="loadContacts">Load Contact List</button><br /><br />
        
        <table id="contactList" border="1" style="border-style:inset"><tr><th>Email</th><th>Email Type</th><th>Updated</th></tr>
        
        </table><br/><br/>
        
        <h2>Add Contact</h2>
        <label>Email:</label>
        <input style="display:inline" type="text" id="email"/>
        <label>Type:</label>
        <select style="display:inline" id="typeSelector"></select>
        
        
        
        <script type="text/javascript">
            //Populates Selector with Email Types 
            var selector = document.getElementById("typeSelector");
            document.onload = function()
            {
                var xmlhttp = new XMLHttpRequest();
                var verb = 'GET';
                var url='proxyAPI.php?resource=emailtypes';
                console.log(url);
                xmlhttp.open(verb, url, true);
                
                 xmlhttp.onreadystatechange = function(){
                
                if (xmlhttp.readyState === 4) {
                    dataArr = new Array();
                    subDataArr = new Array();
                    console.log(xmlhttp.responseText);
                    dataArr = JSON.parse(xmlhttp.responseText);
                    subDataArr = dataArr['data'];
                    selectorData = new Array();
                    
                    for (var i = 0)
                    
                }
            };
        </script>
        <script type="text/javascript">
        var LoadBtn = document.getElementById("loadContacts");
        var results = document.getElementById("contactList");
        
        LoadBtn.addEventListener('click', populateTable);
        
        function populateTable()
        {
            
            var xmlhttp = new XMLHttpRequest();
            var verb = 'GET';
            var url='proxyAPI.php?resource=email';
            console.log(url);
            xmlhttp.open(verb, url, true);
            
            xmlhttp.onreadystatechange = function(){
                
                if (xmlhttp.readyState === 4) {
                    dataArr = new Array();
                    subDataArr = new Array();
                    console.log(xmlhttp.responseText);
                    dataArr = JSON.parse(xmlhttp.responseText);
                    subDataArr = dataArr['data'];
                    
                    results.innerHTML = '<tr><th>Email</th><th>Email Type</th><th>Updated</th></tr>';
                    for(var i = 0;i < subDataArr.length; i++){
                            
                        var line ='';
                        
                        var row = results.insertRow();
                        row.insertCell().innerHTML = subDataArr[i].email;
                        row.insertCell().innerHTML = subDataArr[i].emailtype;
                        row.insertCell().innerHTML = subDataArr[i].lastupdated;                      
                    }
                    
                    //results.innerHTML = output.join('');
                    
                }
                else
                {
                  
                }
                
        };
        xmlhttp.send(null);
            
            
    }
            
        </script>
        
        
        
        
        
    </body>
</html>
