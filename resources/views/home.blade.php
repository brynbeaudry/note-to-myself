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
<?php
$user = Auth::user();
$note = DB::table('notes')->where('userId', $user->id)->first();
$images = DB::table('images')->where('userId', $user->id)->get();
$website_urls = DB::table('websites')->where('userId', $user->id)->value('url');
$tbd = DB::table('tbds')->where('userId', $user->id)->first();
?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{$user->email}}'s notes</div>
                <form id="dashboard" class="" action="/home" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}

                <div class="panel-body">
                    <container>
                      <div class="row">
                        <div class="col-sm-3">
                          <h2>Notes</h1>
                          @if($note!=null)
                            <textarea id="notes" name="notes" value="{{$note->text}}" rows="50"></textarea>
                          @else
                            <textarea id="notes" name="notes" value="" rows="50"></textarea>
                          @endif
                        </div>
                        <div id="websites" class="col-sm-3">
                          <h2>Websites</h2>
                          <h4>Click to Open</h4>
                          @if(count($website_urls))>0)
                          @foreach($website_urls as $url)
                            <input type="text" name="website" value="{{$url}}" onclick=''>
                          @endforeach
                          @endif
                          <input type="text" name="website" value="" onclick=''>
                          <input type="text" name="website" value="" onclick=''>
                          <input type="text" name="website" value="" onclick=''>
                        </div>
                        <div id="images" class="col-sm-3">
                          <h2>Images</h2>
                          <input type="file" name="file" value="" accept="image/gif, image/jpeg">
                          @if(count($images) >0)
                          @foreach($images as $image)
                            <div>
                              <a href="images/{{$image->id}}"><img src="{{$image->path}}" alt="" height=100 width="auto"></a>
                              <label for="checkboxDel">Delete</label>
                              <input id="{{$image->id}}" type="checkbox" name="checkboxDel[]" value="{{$image->id}}" />
                            </div>
                          @endforeach
                          @endif
                        </div>
                        <div class="col-sm-3">
                          <h2>To be Done</h2>
                          @if($tbd!=null)
                            <textarea id="tbd" name="" value="{{$tbd->text}}" rows="50"></textarea>
                          @else
                            <textarea id="tbd" name="" value="" rows="50"></textarea>
                          @endif
                        </div>
                      </div>
                    </container>
                </div>
                <div class="panel-footer">
                  <button type="submit" name="submit" class="btn btn-default btn-block">Save</button>
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
