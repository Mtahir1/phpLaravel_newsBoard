@extends('layouts.app')
@section('content')

</br></br></br>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <select class="form-select" aria-label="Default select example" name="store">
            <option selected disabled> Please select store location</option>
            <option value="North">North</option>
            <option value="South">South</option>
            <option value="East">East</option>
            <option value="West">West</option>
            <option value="Middle">Middle</option>
          </select>
          </div>
      </div>
    </div>
  </div>
</div>


<div id="newsBoard" class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3> Your News Board </h3>
        </div>
        <div class="card-body" id="newsData">

        </div>
      </div>
    </div>
  </div>
</div>


<div id="createNews" class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4> Create an Exciting News 
            <a id="activeStoreSession" href="{{ url('create-news') }}" class="btn btn-danger float-end"> Create News </a>
          </h4>
        </div>
      </div>
    </div>
  </div> 
</div>  
<div id="limitInfo" class="container">
  <div class="row">
    <div class="col-md-12">
      <h6 class="alert alert-success float-end">You have reached your publishing limit of 3 news</h6>
    </div>
  </div>
</div>

@parent
<script>
  window.onload = function() {
    console.log("jQuery has loaded!");
    $('#limitInfo').hide();
    $('#createNews').hide();
    $('#newsBoard').hide();
  }
  
  window.$('select').on('change', function() {
    var store = this.value;
    var urlData = "/news/"+store;
    $.ajax({
      url: urlData,
      type: "GET",
      data:{ 
        _token:'{{ csrf_token() }}'
      },
      cache: false,
      dataType: 'json',
      success: function(dataResult){
        $('#newsData').html("");
        $('#createNews').show();
        $('#newsBoard').show();
        console.log(dataResult);
        var resultData = dataResult.data;
        var newsData = '';
        var i=1;
        $.each(resultData,function(index,row){
          newsData+= 
          "<div class='progress' style='height:40px;'>"+
            "<div class='progress-bar bg-info' role='progressbar' style='width:100%'>"+
              "<h4>"+"News # "+i+" | Published At: "+row.updated_at+"</h4>"+
            "</div>"+
          "</div>"+
          "<h5>"+row.newsHead+"</h5>"+
          "<p>"+row.newsBody+"</p>"+
          "<img  width='250px' height='180px' src="+row.newsImage+">" ;
          i++;
        })
        if(i>3) {
          $('#limitInfo').show();
          $('#createNews').hide();
        }
        else if(i==1) {
          $('#newsBoard').hide();
          $('#limitInfo').hide();
        }
        else{
          $('#limitInfo').hide();
        }
        $("#newsData").append(newsData);
      } 
    });
  }); 
</script>
@endsection