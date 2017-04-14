@extends('layouts.app')

@section('content')
<script>
window.Laravel = {!! json_encode([
    'csrfToken' => csrf_token(),
]) !!};
$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


  //maybe use ajax? Let me know what you think. Do whatever you need to do to get it to work. You can make calls to the resource route with ajax
  // you can also use jquery here
</script>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{Auth::user()->email}}'s notes</div>
                <form id="dashboard" class="" action="/home" method="post" enctype="multipart/form-data">


                <div class="panel-body">
                    <container>
                      <div class="row">
                        <div class="col-sm-3">
                          <h2>Notes</h1>
                          <textarea id="notes" name="" value="" rows="100"></textarea>
                        </div>
                        <div id="websites" class="col-sm-3">
                          <h2>Websites</h2>
                          <h4>Click to Open</h4>
                        </div>
                        <div id="images" class="col-sm-3">
                          <h2>Images</h2>
                          <input type="file" name="filename" accept="image/gif, image/jpeg">
                        </div>
                        <div class="col-sm-3">
                          <h2>To be Done</h2>
                          <textarea id="tbd" name="" value="" rows="100"></textarea>
                        </div>
                      </div>
                    </container>
                </div>
                <div class="panel-footer">
                  <button type="submit" name="save" class="btn btn-default btn-block">Save</button>
                </div>
              </form> <!-- end form-->
            </div>
        </div>
    </div>
</div>
<script>
  //maybe use ajax? Let me know what you think.  You can make calls to the resource route with ajax
  // you can also use jquery here
</script>
@endsection
