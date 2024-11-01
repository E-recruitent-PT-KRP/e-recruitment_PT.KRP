@extends('layoutadmin.main')

@section('content')
    <div class="container">
        <h1>Gallery List</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('gallery.create') }}" class="btn btn-primary mb-3">Create New Gallery</a>

        <div class="table-responsive">
            <table class="table text-start align-middle table-striped table-hover" id="dataTable" width="100%"
                cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar Gallery</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($gallery as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><img src="{{ asset('images/gallery/' . $item->image) }}" alt="Image" width="100"></td>
                            <td>
                                <a href="{{ route('gallery.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-pencil fa-sm"></i>
                                </a>
                                <form action="{{ route('gallery.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">
                                        <i class="fa fa-trash fa-sm"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No jobs available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
