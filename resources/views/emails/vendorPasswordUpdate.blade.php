<!DOCTYPE html>
<html>
<head>
    <title>Email</title>
</head>
<body>
   
<center>
<h2 style="padding: 23px;background: #b3deb8a1;border-bottom: 6px green solid;">
    <a>Vendor management system</a>
</h2>
</center>
<p> Hi {{$firstname .' '.$lastname}},your password has been updated successfully.Please use the following credentials 
    to login in vendor management system.</p><br/>
<strong>Email: {{$email}}</strong><br/>
<strong>Password:{{$password}}</strong>
</body>
</html>