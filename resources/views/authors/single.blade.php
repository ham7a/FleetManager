@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $author->first_name }}</div>

					@if (session('message'))
						<div class="alert alert-info">{{ session('message') }}</div>
					@endif
	
                    <div class="panel-body">
						@can('create', \App\Author::class)
							<a href="{{ route('authors.create') }}" class="btn btn-default">Add New Model</a>
						@endcan
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
									@can('update', \App\Author::class)
										<th>Actions</th>
									@endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($author->$vehiclemodels as $vehiclemodel)
                                <tr>
                                    <td>{{ $vehiclemodel->title }}</td>
                                    <td><img width="50" src={{ $vehiclemodel->photo }} /></td>
									<td>{{ $vehiclemodel->engine }}</td>
									<td>{{ $vehiclemodel->maxpower }}</td>
									<td>{{ $vehiclemodel->fuel }}</td>
									@can('update', \App\Author::class)
                                    <td>
                                        <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-default">Edit</a>
                                        @can('delete', \App\Author::class)
										<form action="{{ route('authors.destroy', $author->id) }}" method="POST"
                                              style="display: inline"
                                              onsubmit="return confirm('Are you sure?');">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
										@endcan
                                    </td>
									@endcan
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No entries found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
						{{ $authors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection