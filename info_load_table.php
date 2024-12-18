<table class="table tablesorter " id="infoTable">
    <thead class=" text-primary">
        <tr>
            <th class="text-center">
                Nomor
            </th>
            <th class="text-center">
                Nama Info
            </th>
            <th class="text-center">
                Jarak
            </th>
            <th class="text-center">
                Waktu
            </th>
            <th class="text-center">
                Lokasi
            </th>
            <th class="text-center">
                Reting
            </th>
            <th class="text-center">
                Deskripsi
            </th>
            <th class="text-center">
                Edit
            </th>
            <th class="text-center">
                Hapus
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Lakukan koneksi ke database
        include '../koneksi.php';

        // Query SQL untuk mengambil data dari tabel info
        $query = "SELECT * FROM info";
        $result = mysqli_query($koneksi, $query);
        // Variabel untuk menyimpan nomor urut
        $counter = 1;
        // Cek jika query berhasil dieksekusi
        if ($result) {
            // Lakukan iterasi untuk menampilkan setiap baris data dalam tabel
            while ($row = mysqli_fetch_assoc($result)) {
                // Menampilkan data ke dalam tabel HTML
                echo "<tr>";
                echo "<td class='text-center'>" . $counter . "</td>";
                echo "<td class='text-center'>" . $row['nama_info'] . "</td>";
                echo "<td class='text-center'>" . $row['jarak'] . "</td>";
                echo "<td class='text-center'>" . $row['waktu'] . "</td>";
                echo "<td class='text-center'>" . $row['lokasi'] . "</td>";
                echo "<td class='text-center'>" . $row['reting'] . "</td>";
                echo "<td class='text-center'>" . $row['deskripsi'] . "</td>";
                echo "<td class='text-center'><img src='" . $row['gambar'] . "' alt='Kover Image' style='max-width: 100px;'></td>";
                echo "<td class='text-center'>
                                                    <button class='btn btn-primary btn-sm' onclick='openEditModal(
                                                        \"" . $row['id_info'] . "\",
                                                        \"" . $row['nama_info'] . "\",
                                                        \"" . $row['jarak'] . "\",
                                                        \"" . $row['waktu'] . "\",
                                                        \"" . $row['lokasi'] . "\",
                                                        \"" . $row['reting'] . "\",
                                                        \"" . $row['deskripsi'] . "\",
                                                        \"" . $row['gambar'] . "\"
                                                    )'>Edit</button>
                                                    <button class='btn btn-danger btn-sm text-center' onclick='deleteGambar(\"" . $row['id_info'] . "\")'>Hapus</button>
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