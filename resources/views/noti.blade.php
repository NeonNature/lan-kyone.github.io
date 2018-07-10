<!DOCTYPE html>
<html lang="en">
<head>
  <title>Notifications - Lan Kyone(Coming soon)</title>
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
      <a class="nav-link" href={{URL::to('notifications')}}><i class="material-icons text-info" style="font-size:30px; ">notifications</i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href={{URL::to('profile')}}><i class="material-icons text-muted" style="font-size:30px;">people</i></a>
    </li>
  </ul>
</nav>


<body>
<div class="container-fluid">

  
<!--Noti --> 
@if($data)
@foreach($data as $data)  
  <div class="modal fade" id={{$data->id}}>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Notification!</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        <div class="text-center">
          <span class="text-danger">{{$data->phone}}</span><small> would like to join your ride to </small> <span class="text-success">{{$data->endpoint}}</span> <small>from</small> <span class="text-info">{{$data->startpoint}}</span>! 
        </div>
        <hr />
        <h6 class="text-center">Desired Location</h6>
           <table class="table">
    <tbody style="font-size:14px;">
      <tr class="table-success">
        <th>To</th>
        <td>{{$data->endpoint1}}</td>
      </tr>
      <tr class="table-info">
        <th>From</th>
        <td>{{$data->startpoint1}}</td>
      </tr>
      
    </tbody>
  </table>
  <div class="form-group">        
        <div class="col-sm-12">
        <a href={{"tel:".$data->phone}}>
          <button type="button" class="btn btn-info btn-block" name="request"><i class="material-icons" style="font-size:22px">phone_in_talk</i></button>
         </a>
        </div>
        <div class="col-sm-12">
        <button type="button" class="btn btn-muted btn-block" name="info" data-toggle="collapse" data-target="#info">User Info</button>
        </div>
        <div id="info" class="collapse">
        <table class="table">
    <tbody style="font-size:14px;">
      <tr>
        <th>Name</th>
        <td>{{$data->name}}</td>
      </tr>
      <tr>
        <th>Phone No.</th>
        <td>{{$data->phone}}</td>
      </tr>
      <tr>
        <th>Uni/Org</th>
        <td>{{$data->university}}</td>
      </tr>
      <tr>
        <th>Rating</th>
        <td>{{$data->rating}}</td>
      </tr>
      
    </tbody>
  </table>
        </div>
        <hr />
        <div class="row">
        <div class="col-6">
          <form action={{URL::to('confirmrequest')}} method="POST">
            <input type="hidden" name="_token" value={{csrf_token()}}>
            <input type="hidden" name="rid" value={{$data->id}}>
            <input type="hidden" name="pid" value={{$data->postid}}>
            <input type="hidden" name="status" value="true">
          <input type="submit" class="btn btn-success btn-block" name="start" value="Accept"><i class="material-icons" style="font-size:22px"></i>
          </form>
        </div>            
        <div class="col-6">
          <form action={{URL::to('confirmrequest')}} method="POST">
            <input type="hidden" name="_token" value={{csrf_token()}}>
            <input type="hidden" name="rid" value={{$data->id}}>
            <input type="hidden" name="pid" value={{$data->postid}}>
            <input type="hidden" name="status" value="false">
          <input type="submit" class="btn btn-danger btn-block" name="reject" value="Decline"><i class="material-icons" style="font-size:22px"></i>
          </form>
        </div>
        </div>
        <hr />
      </div>    
        </div>        
      </div>
    </div>
  </div>

<!--                  --                  --               -->

 
  <a href="view_request.html" class="card bg-light text-dark" style="text-decoration:none; margin-bottom:5px;"  data-toggle="modal" data-target={{'#'.$data->id}} >
    <div class="card-body text-center">
        <span class="text-danger">{{$data->phone}}</span><small> has requested on your ride to </small> <span class="text-success">{{$data->endpoint}}</span> <small>from </small> <span class="text-info">{{$data->startpoint}}</span>! 
    </div>
  </a>

@endforeach
@else
<br><p align="center">No new notifications!</p>
@endif
  
  <!--                  --                  --               -->
  
  
  
</div>
</body>
</html>