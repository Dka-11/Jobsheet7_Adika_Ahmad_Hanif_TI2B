<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak KHS</title>
</head>

<body>
    <h3 class="text-center mt-4">JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h3>
    <h2 class="text-center mt-5 mb-4">KARTU HASIL STUDI (KHS)</h2>
    <strong>Nama: </strong>{{ $mhsMatkul->mahasiswa->nama }}<br>
    <strong>NIM: </strong>{{ $mhsMatkul->mahasiswa->nim }}<br>
    <strong>Kelas: </strong>{{ $mhsMatkul->mahasiswa->kelas->nama_kelas }}
    <table class="table table-striped mt-2">
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
</body>

</html>
