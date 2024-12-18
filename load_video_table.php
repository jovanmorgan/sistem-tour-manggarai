<table class="table tablesorter " id="videoTable">
    <thead class=" text-primary">
        <tr>
            <th>
                Nomor
            </th>
            <th>
                Name
            </th>
            <th>
                Type
            </th>
            <th>
                Durasi
            </th>
            <th>
                Tanggal
            </th>
            <th>
                Alamat
            </th>
            <th>
                Reting
            </th>
            <th>
                Deskripsi
            </th>
            <th>
                Kover
            </th>
            <th class="text-center">
                Video
            </th>
            <th class="text-center">
                Option
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Lakukan koneksi ke database
        include '../koneksi.php';

        // Query SQL untuk mengambil data dari tabel video
        $query = "SELECT * FROM video";
        $result = mysqli_query($koneksi, $query);

        // Variabel untuk menyimpan nomor urut
        $counter = 1;

        // Cek jika query berhasil dieksekusi
        if ($result) {
            // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
            while ($row = mysqli_fetch_assoc($result)) {
                // Menghapus tulisan "data_gambar/" pada data_kover dan membuatnya menjadi $edit_data_kover
                $edit_data_kover = str_replace("data_gambar/", "", $row['data_kover']);
                $edit_data_video = str_replace("data_video/", "", $row['data_video']);

                // Menampilkan data ke dalam tabel HTML
                echo "<tr>";
                echo "<td>" . $counter . "</td>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td>" . $row['durasi'] . "</td>";
                echo "<td>" . $row['tanggal'] . "</td>";
                echo "<td>" . $row['alamat'] . "</td>";
                echo "<td>" . $row['reting'] . "</td>";
                echo "<td>" . $row['deskripsi'] . "</td>";
                echo "<td><img src='" . $row['data_kover'] . "' alt='Kover Image' style='max-width: 100px;'></td>";
                echo "<td class='text-center'><a href='" . $row['data_video'] . "' target='_blank'>Lihat Video</a></td>";
                echo "<td class='text-center'>
                                                    <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                        \"" . $row['id_video'] . "\",
                                                        \"" . $row['nama'] . "\",
                                                        \"" . $row['type'] . "\",
                                                        \"" . $row['durasi'] . "\",
                                                        \"" . $row['alamat'] . "\",
                                                        \"" . $row['reting'] . "\",
                                                        \"" . $row['deskripsi'] . "\",
                                                        \"" . $row['data_kover'] . "\",
                                                        \"" . $row['data_video'] . "\"
                                                    )'>Edit</button>
                                                    <button class='btn btn-danger btn-sm' onclick='deleteVideo(\"" . $row['id_video'] . "\")'>Hapus</button>
                                                </td>";

                echo "</tr>";

                // Increment nomor urut
                $counter++;
            }
        } else {
            echo "Gagal mengambil data dari database";
        }

        // Tutup koneksi ke database
        mysqli_close($koneksi);
        ?>


    </tbody>
</table>