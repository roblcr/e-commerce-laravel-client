@extends('layouts.appadmin')

@section('title')
    Catégories
@endsection

@section('contenu')



      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Catégories</h4>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Nom de la catégorie</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($categories as $category)
                        <tr>
                                                <td>1</td>
                                                <td>{{$category->category_name}}</td>
                                                {{-- <td>
                                                <label class="badge badge-info">On hold</label>
                                                </td> --}}
                                                <td>
                                                <button class="btn btn-outline-primary">Edit</button>
                                                <button class="btn btn-outline-danger">Delete</button>
                                                </td>
                                            </tr>
                      @endforeach

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
