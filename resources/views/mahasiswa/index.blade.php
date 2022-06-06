@extends('mahasiswa.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Input Mahasiswa</a>
            </div>
        </div>
    </div>

    <div class="float-left m-sm-3" style="width: 65%">
        <div class="col-md-6">
            <form action="{{ route('search') }}" method="GET">
                <div class="input-group mb-3">
                    <input class="form-control" type="text" name="search" placeholder="Search Name"
                        value="{{ request('search') }}" aria-describedby="button-addon2">
                    <input type="submit" class="btn btn-secondary" style="display: inline;" value="Search">
                </div>
            </form>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Nim</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th width="50px">Foto</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Tanggal Lahir</th>
            <th width="360px">Action</th>
        </tr>
        @foreach ($mahasiswa as $mhs)
            <tr>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->kelas->nama_kelas }}</td>
                <td>{{ $mhs->jurusan }}</td>
                <td><img width="150px" src="{{ asset('storage/' . $mhs->featured_image) }}"></td>
                <td>{{ $mhs->email }}</td>
                <td>{{ $mhs->alamat }}</td>
                <td>{{ date('d-m-Y', strtotime($mhs->tgl_lahir)) }}</td>
                <td>
                    <form action="{{ route('mahasiswa.destroy', ['mahasiswa' => $mhs->nim]) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('mahasiswa.show', $mhs->nim) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('mahasiswa.edit', $mhs->nim) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <a class="btn btn-warning text-white"
                            href="{{ route('mahasiswa.nilai', $mhs->id_mahasiswa) }}">Nilai
                        </a>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $mahasiswa->links() }}
@endsection
