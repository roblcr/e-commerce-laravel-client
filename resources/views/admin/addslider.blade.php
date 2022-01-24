@extends('layouts.appadmin')

@section('title')
    Ajouter le slider
@endsection

@section('contenu')
        <div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ajouter le slider</h4>
                      {!! Form::open(['action' => 'App\Http\Controllers\SliderController@saveslider', 'method' => 'POST', 'class' => 'cmxform', 'id' => 'commentForm']) !!}
                      {{ csrf_field() }}
                      <div class="form-group">
                          {!! Form::label('', 'Première description', ['for' => 'cname']) !!}
                          {!! Form::text('description_one', '', ['class' => 'form-control', 'id' => 'cname']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::label('', 'Seconde description', ['for' => 'cname']) !!}
                        {!! Form::text('description_two', '', ['class' => 'form-control', 'id' => 'cname']) !!}
                      </div>
                      <div class="form-group">
                        {!! Form::label('', 'Image du produit', ['for' => 'cname']) !!}
                        {!! Form::file('slider_image', ['class' => 'form-control', 'id' => 'cname']) !!}
                      </div>

                      {{-- <div class="form-group">
                        <label for="cemail">E-Mail (required)</label>
                        <input id="cemail" class="form-control" type="email" name="email" required>
                      </div>
                      <div class="form-group">
                        <label for="curl">URL (optional)</label>
                        <input id="curl" class="form-control" type="url" name="url">
                      </div>
                      <div class="form-group">
                        <label for="ccomment">Your comment (required)</label>
                        <textarea id="ccomment" class="form-control" name="comment" required></textarea>
                      </div> --}}

                      {!! Form::submit('Ajouter', ['class' => 'btn btn-primary']) !!}
                   {!! Form::close() !!}
                </div>
              </div>
            </div>
          </div>
@endsection

@section('scripts')
<script src="backend/js/form-validation.js"></script>
<script src="backend/js/bt-maxLength.js"></script>
@endsection
