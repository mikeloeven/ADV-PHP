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
        
        <label id="statusBox"></label>
        
        <h1> Contacts List </h1>
        
        <button id="loadContacts">Load Contact List</button><br /><br />
        
        <table id="contactList" border="1" style="border-style:inset"><tr><th>Email</th><th>Email Type</th><th>Updated</th></tr>
        
        </table><br/><br/>
        
        <h2>Add Contact</h2>
        <label>Email:</label>
        <input style="display:inline" type="text" id="email"/>
        <label>Type:</label>
        <select style="display:inline" id="typeSelector"></select>
        <button style="display:inline" id="addEmail">Add Email</button>
        
        
        
        <script type="text/javascript">
            //Populates Selector with Email Types 
            var selector = document.getElementById("typeSelector");
            document.onload = loadSelector();
            function loadSelector()
            {
                
                var xmlhttp = new XMLHttpRequest();
                var verb = 'GET';
                var url='proxyAPI.php?resource=emailtypes';
                
                xmlhttp.open(verb, url, true);
                
                xmlhttp.onreadystatechange = function(){
                
                    if (xmlhttp.readyState === 4) {
                        dataArr = new Array();
                        subDataArr = new Array();
                        console.log(xmlhttp.responseText);
                        dataArr = JSON.parse(xmlhttp.responseText);
                        subDataArr = dataArr['data'];
                        selectorData = new Array();
                        console.log("INIT");
                    for (var i = 0; i < subDataArr.length; i++)
                    {
                        console.log(i);
                        if (subDataArr[i].active===1)
                        {
                            console.log("Success");
                            var line = '';
                            line += '<option Value="';
                            line += subDataArr[i].emailtypeid;
                            line += '">';
                            line += subDataArr[i].emailtype;
                            line += '</option>';
                            
                            selectorData.push(line);                            
                        }
                    }
                    console.log(selectorData.join(''));
                    selector.innerHTML = selectorData.join('');
                    console.log(document.getElementById("typeSelector"));
                    
                    
                    }
                    else
                    {
                      
                    }
                };        
                xmlhttp.send(null);
            }
        </script>
        
        <script type="text/javascript">
        
        var AddBtn = document.getElementById("addEmail");
        var Response = document.getElementById("statusBox");
        
        AddBtn.addEventListener('click', addEmail);
        
        function addEmail()
        {
            console.log("Call");
            var data = '';
            data += 'email=';
            data += document.getElementById("email").value;
            data += '&emailtypeid=';
            var etype = document.getElementById("typeSelector");
            data += etype.options[etype.selectedIndex].value;
            data += '&active=1';
            
            var xmlhttp = new XMLHttpRequest();
            var url='proxyAPI.php?resource=email';
            console.log(url);
            xmlhttp.open("POST", url, true);
            
            xmlhttp.onreadystatechange = function(){
                
                if (xmlhttp.readyState === 4) {
                    Response.innerHTML = xmlhttp.responseText;
                }
                else
                {
                  
                }
                
            };
            
            xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            console.log(data);
            xmlhttp.send(data);
            
            
        }
        
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
                        if (subDataArr[i].active===1)
                        {
                        var line ='';
                        
                        var row = results.insertRow();
                        row.insertCell().innerHTML = subDataArr[i].email;
                        row.insertCell().innerHTML = subDataArr[i].emailtype;
                        row.insertCell().innerHTML = subDataArr[i].lastupdated; 
                        }
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
