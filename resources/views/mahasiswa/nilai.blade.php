@extends('mahasiswa.layout')

@section('content')
    {{-- @dump($Mahasiswa->matakuliah) --}}
    <div class="container text-center">
        <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
        <h1>KARTU HASIL STUDI (KHS)</h1>
        <div class="row">
            <div class="col-sm-10">
                <strong>Nama: </strong>{{ $mhsMatkul->mahasiswa->nama }}<br>
                <strong>NIM: </strong>{{ $mhsMatkul->mahasiswa->nim }}<br>
                <strong>Kelas: </strong>{{ $mhsMatkul->mahasiswa->kelas->nama_kelas }}
            </div>
            <div class="col-sm-2">
                <a href="{{ route('mahasiswa.cetakKhs', $mhsMatkul->mahasiswa->id_mahasiswa) }}"
                    class="btn btn-success float-right">Cetak KHS</a>
            </div>
        </div>

        <table class="table table-striped mt-2">
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
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-primary">Kembali</a>
            </div>
    </div>
@endsection
