<!DOCTYPE html>
<html>
<head>
<title>Lan Kyone</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<style>
/* Center the loader */
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 0.5s linear infinite;
  animation: spin 0.5s linear infinite;
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}
@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}
@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}
#page {
  display: none;
  text-align: center;
}
</style>

<script>
var vload;
function myFunction() {
    vload = setTimeout(showPage, 1000);
}
function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("page").style.display = "block";
}
</script>
</head>
<body onload="myFunction()" style="margin:0;">

<div id="loader"></div>

<div style="display:none;" id="page" class="animate-bottom container">
  <br />
  <img src={{asset('images/logo.png')}} alt="Logo" style="margin:0 auto; display: table;" class="img-fluid" />
  <br />
  <p align="center">#ride-sharing<big><em>#safety-on-board</em></big>#reduce-cost</p>
  <br>
  <p align="center">Your safety and affordability is our value.</p>
  <br />


  <form class="form-horizontal" action={{URL::to('/')}} method="POST">
    <div class="form-group">
      <input type="hidden" name="_token" value={{csrf_token()}}>
      <div class="col-sm-12">
        <input type="text" class="form-control" id="email" placeholder="Phone number" name="phone">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">          
        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-12">
        <button type="submit" class="btn btn-block btn-success">Log In</button>
      </div>
    </div>
  </form>
  <p class="text-center">
    Don't have an account? <a href={{URL::to('register')}}>Register here!</a>
  </p>
</div>


</body>
</html>