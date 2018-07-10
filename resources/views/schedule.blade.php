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
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBytuG8X36rpZrgNZQyFkYy19zyxhuwdeg&sensor=false&libraries=places"></script>
  <script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('search'));
        google.maps.event.addListener(places, 'place_changed', function () {

        });
    });
    google.maps.event.addDomListener(window, 'load', function () {
        var start = new google.maps.places.Autocomplete(document.getElementById('to'));
        google.maps.event.addListener(start, 'place_changed', function () {

        });
    });
</script>

</head>


<nav class="navbar navbar-expand  navbar-dark sticky-top" style="background-color:#FFF";>
    <ul class="nav w-100 nav-justified border-bottom">
    <li class="nav-item">
      <a class="nav-link" href={{URL::to('schedule')}}><i class="material-icons text-info" style="font-size:30px;">event_note</i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href={{URL::to('notifications')}}><i class="material-icons text-muted" style="font-size:30px; ">notifications</i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href={{URL::to('profile')}}><i class="material-icons text-muted" style="font-size:30px;">people</i></a>
    </li>
  </ul>
</nav>


<body>
<div class="container-fluid">
<form class="form-inline" action="schedule/search" method="get">
    <input class="form-control col-10" id="search" type="text" placeholder="Where do you want to go?" name="search">
    <button class="btn btn-success col-2" type="submit"><i class="material-icons" style="font-size:16px;">search</i></button>
  </form>
  <hr />
  
<!--Create --> 
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Create a Request</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action={{URL::to('schedule/add')}} method="POST">
    <div class="form-group">
      <div class="col-sm-12">
        <input type="hidden" name="_token" value={{csrf_token()}}>
        <input type="text" class="form-control" placeholder="To" name="to">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <input type="text" class="form-control" placeholder="From" name="from">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <input type="number" class="form-control" placeholder="Expected Fee (Ks)" name="efee">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <input type="number" class="form-control" placeholder="Desired Payment (Ks)" name="pfee">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <input type="time" class="form-control" name="time">
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-12">
        <textarea rows="2" class="form-control" name="note" placeholder="Additional Description"></textarea>
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-12">
        <button type="submit" class="btn btn-block btn-success">Request</button>
      </div>
    </div>
  </form>
        </div>
        
      </div>
    </div>
  </div>

<!--                  --                  --               -->
@if($mode)
@if($mode="all")
  @foreach($data as $data)
  <a href="view_request.html" class="card bg-light text-dark" style="text-decoration:none; margin-bottom:5px;"  data-toggle="modal" data-target={{'#'.$data->id}} >
    <div class="card-body">
        <small>To</small> <span class="text-success">{{$data->startpoint}}</span><br /> 
        <small>From</small> <span class="text-info">{{$data->endpoint}}</span> 
        
        <small><span class="float-right">at {{$data->time}}</span></small>
    </div>
  </a>
  <div class="modal fade" id={{$data->id}}>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"> 
        <h4 class="modal-title">View Request</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="collapse modalrequest show">
           <table class="table">
    <tbody style="font-size:14px;">
      <tr class="table-success">
        <th>To</th>
        <td>{{$data->startpoint}}</td>
      </tr>
      <tr class="table-success">
        <th>From</th>
        <td>{{$data->endpoint}}</td>
      </tr>
      <tr class="table-primary">
        <th>Expected Fee</th>
        <td>{{$data->expected}}</td>
      </tr>
      <tr class="table-primary">
        <th>Desired Payment</th>
        <td>{{$data->pay}}</td>
      </tr>      
      <tr class="table-danger">
        <th>Time</th>
        <td>{{$data->time}}</td>
      </tr>
      <tr class="table-warning">
        <th>Notes</th>
        <td>{{$data->note}}</td>
      </tr>
      <tr class="table-warning">
        <th>By</th>
        <td>{{$data->phone}}</td>
      </tr>
    </tbody>
  </table>

  <div class="form-group">        
        <div class="col-sm-12">
          <button type="button" class="btn btn-success btn-block" data-toggle="collapse" data-target=".modalrequest" name="request">Request</button>
        </div>
      </div>

    </div>

    <div class="modalrequest collapse">
      <form name="rider2" action={{URL::to('request')}} method="POST">
      <div class="form-group">        
        <div class="col-sm-12">
          <input type="hidden" name="postid" value={{$data->id}}>
          <input type="hidden" name="_token" value={{csrf_token()}}>
          <button type="button" class="btn btn-muted btn-block" data-toggle="collapse" data-target=".modalrequest" name="back">Back</button>
        </div>
      </div>

      <div class="form-group">
      <div class="col-sm-12">
        <input type="text" class="form-control" placeholder="To" name="to2">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <input type="text" class="form-control" placeholder="From" name="from2">
      </div>
    </div>

    <div class="form-group">        
        <div class="col-sm-12">
          <button type="submit" class="btn btn-success btn-block" name="request">Request</button>
        </div>
      </div>
  </form>
    </div>


        </div>
        
      </div>
    </div>
  </div>
  @endforeach
  @elseif($mode="search")
  @foreach($data as $data)
  <a href="view_request.html" class="card bg-light text-dark" style="text-decoration:none; margin-bottom:5px;"  data-toggle="modal" data-target={{'#'.$data->id}} >
    <div class="card-body">
        <small>To</small> <span class="text-success">{{$data->startpoint}}</span><br /> 
        <small>From</small> <span class="text-info">{{$data->endpoint}}</span> 
        
        <small><span class="float-right">at {{$data->time}}</span></small>
    </div>
  </a>
  <div class="modal fade" id={{$data->id}}>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"> 
        <h4 class="modal-title">View Request</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="collapse modalrequest show">
           <table class="table">
    <tbody style="font-size:14px;">
      <tr class="table-success">
        <th>To</th>
        <td>{{$data->startpoint}}</td>
      </tr>
      <tr class="table-success">
        <th>From</th>
        <td>{{$data->endpoint}}</td>
      </tr>
      <tr class="table-primary">
        <th>Expected Fee</th>
        <td>{{$data->expected}}</td>
      </tr>
      <tr class="table-primary">
        <th>Desired Payment</th>
        <td>{{$data->pay}}</td>
      </tr>      
      <tr class="table-danger">
        <th>Time</th>
        <td>{{$data->time}}</td>
      </tr>
      <tr class="table-warning">
        <th>Notes</th>
        <td>{{$data->note}}</td>
      </tr>
      <tr class="table-warning">
        <th>By</th>
        <td>{{$data->phone}}</td>
      </tr>
    </tbody>
  </table>

  <div class="form-group">        
        <div class="col-sm-12">
          <button type="button" class="btn btn-success btn-block" data-toggle="collapse" data-target=".modalrequest" name="request">Request</button>
        </div>
      </div>

    </div>

    <div class="modalrequest collapse">
      <form name="rider2" action={{URL::to('request')}} method="POST">
      <div class="form-group">        
        <div class="col-sm-12">
          <input type="hidden" name="postid" value={{$data->id}}>
          <input type="hidden" name="_token" value={{csrf_token()}}>
          <button type="button" class="btn btn-muted btn-block" data-toggle="collapse" data-target=".modalrequest" name="back">Back</button>
        </div>
      </div>

      <div class="form-group">
      <div class="col-sm-12">
        <input type="text" class="form-control" placeholder="To" name="to2">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-12">
        <input type="text" class="form-control" placeholder="From" name="from2">
      </div>
    </div>

    <div class="form-group">        
        <div class="col-sm-12">
          <button type="submit" class="btn btn-success btn-block" name="request">Request</button>
        </div>
      </div>
  </form>
    </div>


        </div>
        
      </div>
    </div>
  </div>
  @endforeach
  @endif
  @endif
  
  <!--                  --                  --               -->
  
  
  
  
  
  
  <!-- Keep this at bottom -->
  <button type="button" class="btn btn-info rounded-circle" data-toggle="modal" data-target="#myModal" style="position: fixed;  bottom: 50px; right: 50px; width:60px; height: 60px;">
   <span style="font-weight: bold; margin: 0 auto; display: table;">+</span>
  </button>
</div>
</body>
</html>