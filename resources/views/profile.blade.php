<!DOCTYPE html>
<html lang="en">
<head>
  <title>Schedule - Lan Kyone(Coming soon)</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>


<nav class="navbar navbar-expand  navbar-dark sticky-top" style="background-color:#FFF";>
    <ul class="nav w-100 nav-justified border-bottom">
    <li class="nav-item">
      <a class="nav-link" href={{URL::to('schedule')}}><i class="material-icons text-muted" style="font-size:30px;">event_note</i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href={{URL::to('notifications')}}><i class="material-icons text-muted" style="font-size:30px; ">notifications</i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href={{URL::to('profile')}}><i class="material-icons text-info" style="font-size:30px;">people</i></a>
    </li>
  </ul>
</nav>


<body>
<div class="container-fluid">
 <table class="table">
    <tbody style="font-size:14px;">
      <tr>
        <th>Name</th>
        <td>{{Auth::user()->name}}</td>
      </tr>
      <tr>
        <th>Role</th>
        <td>{{Auth::user()->role}}</td>
      </tr>
      <tr>
        <th>NRC / Office ID</th>
        <td>{{Auth::user()->nrc}}</td>
      </tr>
      <tr>
        <th>Org / Uni</th>
        <td>{{Auth::user()->university}}</td>
      </tr>
      <tr>
        <th>Rating</th>
        <td>{{Auth::user()->rating}}</td>
      </tr>      
      
    </tbody>
  </table>
  <div class="col-sm-12">
        <a href={{URL::to('logout')}}><button type="button" class="btn btn-danger btn-block" name="logout">Logout</button></a>
        </div>
</div>
</body>
</html>