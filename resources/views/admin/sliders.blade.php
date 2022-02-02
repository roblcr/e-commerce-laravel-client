@extends('layouts.appadmin')

@section('title')
    Sliders
@endsection

{{{ Form::hidden('', $increment = 1) }}}

@section('contenu')



      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Sliders</h4>
          @if (Session::has('status'))
            <div class="alert alert-success">
                {{Session::get('status')}}
            </div>

          @endif
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Image</th>
                        <th>Description One</th>
                        <th>Description Two</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($sliders as $slider)
                      <tr>
                        <td>{{$increment}}</td>
                        <td><img src="storage/slider_images/{{$slider->slider_image}}" alt=""></td>
                        <td>{{$slider->description_one}}</td>
                        <td>{{$slider->description_two}}</td>
                        <td>
                            @if ($slider->status == 1)
                                <label class="badge badge-success">Activé</label>
                            @else
                                <label class="badge badge-danger">Desactivé</label>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-outline-primary" onclick="window.location ='{{url('/edit_slider/'.$slider->id)}}'">Edit</button>
                            <a class="btn btn-outline-danger" href="{{url('/delete_slider/'.$slider->id)}}" id="delete">Delete</a>
                            @if ($slider->status == 1)
                                <button class="btn btn-outline-warning" onclick="window.location ='{{url('/deactivate_product/'.$slider->id)}}'">Désactiver</button>
                            @else
                                <button class="btn btn-outline-success" onclick="window.location ='{{url('/activate_product/'.$slider->id)}}'">Activer</button>
                            @endif
                        </td>
                    </tr>
                      @endforeach
                      {{{ Form::hidden('', $increment=$increment + 1) }}}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>



@endsection

@section('scripts')
<script src="backend/js/data-table.js"></script>
@endsection
