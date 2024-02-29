@extends('dashboard.layout')
@section('konten')
 
<p class="card-title">Halaman</p>
<div class="pb-3"><a href="{{ route('halaman.create') }}" class="btn btn-primary">Tambah Halaman</a></div>
<div class="table-responsive">
    <table class="table table-stripped">
        <thead>
            <tr>
                <th class="col-1">No</th>
                <th>Judul</th>
                <th class="col-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>
                        <a href="{{ route('halaman.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('halaman.destroy', $item->id)}}"         method="post" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete Data?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

