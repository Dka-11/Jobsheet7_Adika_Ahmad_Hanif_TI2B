@extends('mahasiswa.layout')

@section('content')
    {{-- @dump($Mahasiswa->matakuliah) --}}
    <div class="container text-center">
        <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
        <h1>KARTU HASIL STUDI (KHS)</h1>
        <div class="text-left">
            <p><b>Nama : </b>{{ $mhsMatkul->mahasiswa->nama }}</p>
            <p><b>NIM : </b>{{ $mhsMatkul->mahasiswa->nim }}</p>
            <p><b>Kelas : </b>{{ $mhsMatkul->mahasiswa->kelas->nama_kelas }}</p>

        </div>
        <table class="table table-bordered">
            <tr>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Semester</th>
                <th>Nilai</th>
                @foreach ($mhsMatkul as $nilai)
            <tr>
                <td>{{ $nilai->matakuliah->nama_matkul }}</td>
                <td>{{ $nilai->matakuliah->sks }}</td>
                <td>{{ $nilai->matakuliah->semester }}</td>
                <td>{{ $nilai->nilai }}</td>
            </tr>
            @endforeach
        </table>
        <div class="row justify-content-end">
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-success">Kembali</a>
        </div>
    </div>
@endsection
